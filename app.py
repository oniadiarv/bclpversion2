from flask import Flask, render_template, request, redirect, url_for,jsonify,session, flash
import hashlib
import mysql.connector
import churn as ch
import json 
import datetime
import os
from collections import Counter

# Get the current date and time
current_datetime = datetime.datetime.now()


# Extract the current year
current_year = current_datetime.year

app = Flask(__name__)
app.secret_key = 'your_secret_key'

 
# Database connection
def get_db_connection():
    connection = mysql.connector.connect(
        host='o61qijqeuqnj9chh.cbetxkdyhwsb.us-east-1.rds.amazonaws.com',
        user='pqsw14zceyi323wb',  # Default XAMPP username
        password='lsl9f78axmkrbe4p',  # Default XAMPP password
        database='spt5u5edpuha1lkf'  
    )
    return connection    
   

# for index    ########################################################### 
@app.route("/")
def bclp():
    return render_template("index.php")

# for webpage    ########################################################### 
@app.route('/get_barangays')
def get_barangays():
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("SELECT DISTINCT barangay FROM users")
    barangays = cursor.fetchall()
    cursor.close()
    connection.close()
    return jsonify(barangays)

@app.route('/get_courses/<barangay>')
def get_courses(barangay):
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("SELECT DISTINCT c.courseId, c.courseTitle FROM course c JOIN schedule s ON c.courseId = s.courseId JOIN users u ON s.userid = u.userid WHERE u.barangay = %s ", (barangay,))
    courses = cursor.fetchall()
    cursor.close()
    connection.close()
    return jsonify(courses)

@app.route('/get_time/<courseId>')
def get_time(courseId):
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("SELECT DISTINCT time, sem FROM schedule WHERE courseId = %s AND status = 'Open'", (courseId,))
    times = cursor.fetchall()
    cursor.close()
    connection.close()
    return jsonify(times)

@app.route('/bclp_webpageAssessment', methods=['POST'])
def assessment():
    if request.method == "POST":
        branch = request.form["branch"]
        course = request.form["level"]
        time = request.form["time"]
        sem = request.form["sem"]

        lastName = request.form["lastName"]
        firstName = request.form["firstName"]
        middleName = request.form["middleName"]
        suffix = request.form["suffix"]
        dob = request.form["dob"]
        age = int(request.form["age"])
        gender = request.form["sex"]
        status = request.form["status"]

        telepono = request.form["cellphone"]
        email = request.form["email"]
        education = request.form["educationalAttainment"]
        lastSchoolAttended = request.form["lastSchoolAttended"]

        schoolYear = request.form["schoolYear"]
        educationalBackground = request.form["educationalBackground"]
        barangay = request.form["barangay"]
        district = request.form["district"]
        province = request.form["province"]
        completeAddress = request.form["completeAddress"]
     
        connection = get_db_connection()
        cursor = connection.cursor()
        cursor.execute('SELECT * FROM questions')
        questions = cursor.fetchall()
        cursor.close()
        connection.close()
        
        return render_template('bclp_webpageAssess.php', questions=questions,branch=branch,course=course,time=time,sem=sem, lastName=lastName,firstName=firstName,middleName=middleName,
                                dob= dob, age=age,suffix=suffix,gender=gender,status=status,numero=telepono,email=email,education=education ,lastSchoolAttended =lastSchoolAttended ,
                                schoolYear=schoolYear,educationalBackground=educationalBackground,barangay =barangay ,district = district, province=province,completeAddress=completeAddress)

# saving enrollment application ##################################################### 
@app.route("/bclp_webpageSave", methods=['POST'])
def submit():
    if request.method == "POST":
        branch = request.form["branch"]
        course = request.form["level"]
        time = request.form["time"]
        sem = request.form["sem"]

        lastName = request.form["lastName"]
        firstName = request.form["firstName"]
        middleName = request.form["middleName"]
        suffix = request.form["suffix"]
        dob = request.form["dob"]
        age = int(request.form["age"])
        gender = request.form["sex"]
        status = request.form["status"]

        ayaw = request.form["tawag"]
        email = request.form["email"]
        education = request.form["educationalAttainment"]
        lastSchoolAttended = request.form["lastSchoolAttended"]

        schoolYear = request.form["schoolYear"]
        educationalBackground = request.form["educationalBackground"]
        barangay = request.form["barangay"]
        district = request.form["district"]
        province = request.form["province"]
        completeAddress = request.form["completeAddress"]

        totalItemTest = int(request.form["totalquestion"])
        total_yes = sum(1 for key in request.form if key.startswith('question_') and request.form[key] == 'yes')

        average, topics = ch.churn_prediction(gender, age, total_yes, totalItemTest, course)

        topics_json = json.dumps(topics)
        formatted_topics = topics_json.strip('[]').replace('"', '')
       # topics_string = ', '.join(topics) 
        
        # Save data to the database
        connection = get_db_connection()
        cursor = connection.cursor()
        cursor.execute("""
            INSERT INTO enrollee (branch,courseId,time,sem,lastname,firstname,middlename,suffix,dob,age,sex,status,contact,email,educational,lastSchoolAttend,schoolYear,eduBackground,barangay,district,province,completeAddress,score,totalquestion, recommend,batch,isStudent)
            VALUES (%s,%s, %s,%s, %s,%s, %s,%s,%s, %s,%s,%s, %s,%s, %s, %s, %s,%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
        """,(branch,course,time,sem,lastName,firstName,middleName,suffix,dob,age,gender, status,ayaw,email,education,lastSchoolAttended,schoolYear,educationalBackground,barangay,district, province,completeAddress,average,totalItemTest, formatted_topics, current_year,'Enrollee'))
        connection.commit()
        cursor.close()
        connection.close()
        flash("Your Application Accepted Successfully!")
        return redirect(url_for('bclp'))

# back button #######################################################
  
@app.route("/index")
def back():
    return bclp()

 # login structure ######################################################
@app.route("/login", methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        username = request.form['username']
        password = hashlib.md5(request.form['password'].encode()).hexdigest()

        conn = get_db_connection()
        cursor = conn.cursor(dictionary=True)
        cursor.execute("SELECT * FROM users WHERE username = %s AND password = %s", (username, password))
        user = cursor.fetchone()
        cursor.close()
        conn.close()
        
        # Check credentials
        if user:
            session['user'] = user
            if user['userType'] == 'Instructor':
                connection = get_db_connection()
                cursor = connection.cursor()
                cursor.execute("INSERT INTO activity_log (userid, userType, Name, activity, date) VALUES (%s, %s, %s,%s, %s)", (user['userid'], user['userType'], user['username'], 'Login', current_datetime))
                connection.commit()
                cursor.close()
                connection.close()   
                return redirect(url_for('instructor_dashboard'))
            elif user['userType'] == 'Administrator':
                connection = get_db_connection()
                cursor = connection.cursor()
                cursor.execute("INSERT INTO activity_log (userid, userType, Name, activity, date) VALUES (%s, %s, %s,%s, %s)", (user['userid'], user['userType'], user['username'], 'Login', current_datetime))
                connection.commit()
                cursor.close()
                connection.close()
                return redirect(url_for('admin_dashboard'))
            else:
                 flash("Wrong Username or Password")
                 return redirect(url_for('login'))
    return render_template("bclp_login.php")

# admin codes ##############################################################
@app.route("/admin_dashboard")
def admin_dashboard():
    user = session.get('user')
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("SELECT COUNT(*) AS total_males FROM student WHERE sex = 'Male'")
    male = cursor.fetchone()
    male_count = male[0]

    cursor.execute("SELECT COUNT(*) AS total_males FROM student WHERE sex = 'female'")
    female = cursor.fetchone()
    female_count = female[0]

    cursor.execute("SELECT COUNT(*) AS total_males FROM student where courseId = 'CRS01'")
    course1 = cursor.fetchone()
    course1_count = course1[0]
    
    cursor.execute("SELECT COUNT(*) AS total_males FROM student where courseId = 'CRS02'")
    course2 = cursor.fetchone()
    course2_count = course2[0]
    
    cursor.execute("SELECT COUNT(*) AS total_males FROM student where courseId = 'CRS03'")
    course3 = cursor.fetchone()
    course3_count = course3[0]

    cursor.close()
    connection.close()

    return render_template("admin_dashboard.php",user=user,male=male_count,female = female_count,course1=course1_count,course2=course2_count,course3=course3_count)

# admin codes - adding courses ##############################################################
@app.route("/admin_addCourse")
def admin_addCourse():
    user = session.get('user')
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("SELECT * FROM course ")
    results = cursor.fetchall()
    cursor.close()
    connection.close()
    
    return render_template("admin_addCourse.php",results=results,user=user)

@app.route('/admin_add_course', methods=['POST'])
def admin_add_course():
    user = session.get('user')
    course_lvl = request.form['courseLvl']
    course_title = request.form['courseTitle']
    course_desc = request.form['courseDesc']
    
    # Generate courseId
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("SELECT COUNT(*) FROM course")
    count = cursor.fetchone()[0]
    course_id = f'CRS{count + 1:02d}'

    cursor.execute("INSERT INTO course (courseId, courseLvl, courseTitle, courseDesc) VALUES (%s, %s, %s, %s)",
                   (course_id, course_lvl, course_title, course_desc))
    
    cursor.execute("INSERT INTO activity_log (userid, userType, Name, activity, date) VALUES (%s, %s, %s,%s, %s)", (user['userid'], user['userType'], user['username'], 'Add Course', current_datetime))
    connection.commit()
    cursor.close()
    connection.close()
    
    return redirect(url_for('admin_addCourse'))

@app.route('/admin_delete_course/<string:courseId>')
def admin_delete_course(courseId):
       user = session.get('user')
       connection = get_db_connection()
       cursor = connection.cursor()
       cursor.execute("DELETE FROM course WHERE courseId = %s", (courseId,))

       cursor.execute("INSERT INTO activity_log (userid, userType, Name, activity, date) VALUES (%s, %s, %s,%s, %s)", (user['userid'], user['userType'], user['username'], 'Delete Course', current_datetime))
       connection.commit()

       cursor.close()
       connection.close()

       return redirect(url_for('admin_addCourse'))

# admin codes  ##############################################################
@app.route("/admin_manageuser")
def admin_manageuser():
    user = session.get('user')
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("SELECT * FROM users ")
    results = cursor.fetchall()
    cursor.close()
    connection.close()

    return render_template("admin_manageuser.php",results=results,user=user)

# admin codes - adding users ##############################################################

def validate_password(password):
    if (len(password) < 8 or
        not any(char.isdigit() for char in password) or
        not any(char.islower() for char in password) or
        not any(char.isupper() for char in password) or
        not any(char in '!@#$%^&*()_+' for char in password)):
        return False
    return True

@app.route('/insert_admin_manageuser', methods=['POST'])
def insert_admin_manageuser():
    user = session.get('user')
    userType = request.form['userType']
    barangay = request.form['barangay']
    fname = request.form['fname']
    mname = request.form['mname']
    lname = request.form['lname']
    email = request.form['email']
    username = request.form['username']
    password = request.form['password']
    confirm_password = request.form['confirm']
    
    # Validate names
    if any(char.isdigit() for char in fname + mname + lname):
        flash('First, Middle, and Last names cannot contain numbers !')
        return redirect(url_for('admin_manageuser'))
    
    # Validate password
    if not validate_password(password):
        flash('Password must meet complexity requirements !')
        return redirect(url_for('admin_manageuser'))
    
    if password != confirm_password:
        flash('Passwords do not match !')
        return redirect(url_for('admin_manageuser'))
    
    # Hash the password
    hashed_password = hashlib.md5(password.encode()).hexdigest()
    
    # Handle image upload
    image = request.files['image']
    image_path = os.path.join('static/img', image.filename)
    image.save(image_path)

    # Save user to database
    conn = get_db_connection()
    cursor = conn.cursor()
    cursor.execute('INSERT INTO users (userType, barangay, fname, mname, lname, email, image, username, password) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)',
                   (userType, barangay, fname, mname, lname, email, image.filename, username, hashed_password))
    conn.commit()

    
    cursor.execute("INSERT INTO activity_log (userid, userType, Name, activity, date) VALUES (%s, %s, %s,%s, %s)", (user['userid'], user['userType'], user['username'], 'Add New User', current_datetime))
    conn.commit()

    cursor.close()
    conn.close()
    flash("New user is added Successfully!")
    return redirect(url_for('admin_manageuser'))

# admin codes - updating users info ##############################################################

@app.route('/update_admin_manageuser',methods=['POST','GET'])
def update_admin_manageuser():
    if request.method == 'POST':
        user = session.get('user')
        userid = request.form['userid']
        userType = request.form['userType']
        barangay = request.form['barangay']
        fname = request.form['fname']
        mname = request.form['mname']
        lname = request.form['lname']
        email = request.form['email']
        username = request.form['username']
        image = request.files['image']

        image_path = os.path.join('static/img', image.filename)
        image.save(image_path)

        connection = get_db_connection()
        cursor = connection.cursor()
        cursor.execute("""
            UPDATE users SET userType =%s, barangay=%s, fname=%s, mname=%s,lname=%s, email=%s, image=%s, username=%s where userid = %s
        """,                (userType,barangay,fname,mname,lname,email,image.filename,username,userid))

        cursor.execute("INSERT INTO activity_log (userid, userType, Name, activity, date) VALUES (%s, %s, %s,%s, %s)", (user['userid'], user['userType'], user['username'], 'Update user data', current_datetime))

        connection.commit()
        cursor.close()
        connection.close()
        flash("User information is updated Successfully!")
        return redirect(url_for('admin_manageuser'))
    
# admin codes - audit ##############################################################

@app.route("/admin_auditTrail")
def admin_auditTrail():
    user = session.get('user')
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("SELECT * FROM activity_log ORDER BY date DESC ")
    results = cursor.fetchall()
    cursor.close()
    connection.close()

    return render_template("admin_auditTrail.php",results=results,user=user)

# admin codes - notification ###############################################################
@app.route("/admin_notification")
def admin_notification():
    user = session.get('user')
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("SELECT * FROM announcement ")
    results = cursor.fetchall()
    cursor.close()
    connection.close()
    
    return render_template("admin_notification.php",results=results,user=user)

@app.route('/admin_add_notification', methods=['POST'])
def add_notification():
    message = request.form['message']
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute('INSERT INTO announcement (message) VALUES (%s)', (message,))
    connection.commit()
    cursor.close()
    connection.close()
    flash('Notification added successfully!')
    return redirect(url_for('admin_notification'))

@app.route('/admin_delete_notification/<int:announceId>')
def admin_delete_notification(announceId):
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute('DELETE FROM announcement WHERE announceId = %s', (announceId,))
    connection.commit()
    cursor.close()
    connection.close()
    flash('Notification deleted successfully!')
    return redirect(url_for('admin_notification'))

# admin codes - report ###############################################################
@app.route("/admin_manageReport")
def admin_manageReport():
    user = session.get('user')
    return render_template("admin_manageReport.php",user=user)

@app.route('/admin_get_course')
def admin_get_course():
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("SELECT DISTINCT courseId FROM student")
    courseId = cursor.fetchall()
    cursor.close()
    connection.close()
    return jsonify(courseId)

@app.route('/admin_get_site')
def admin_get_site():
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("SELECT DISTINCT branch FROM student")
    branch = cursor.fetchall()
    cursor.close()
    connection.close()
    return jsonify(branch)

@app.route('/search_admin_manageReport',methods=['POST','GET'])
def search_admin_manageReport():
    user = session.get('user')
    if request.method == 'POST':
        course = request.form['course']
        sem = request.form['sem']
        status = request.form['status']
        batch = request.form['batch']
        branch = request.form['branch']

        connection = get_db_connection()
        cursor = connection.cursor()
        cursor.execute("SELECT * FROM student WHERE courseId = %s AND sem = %s AND isStudent = %s AND branch = %s AND batch = %s ", (course,sem,status,branch,batch))
        results = cursor.fetchall()
        connection.commit()
        cursor.close()
        connection.close()
       
        #return redirect(url_for('instructor_manageReport',results = results))
        return render_template("admin_manageReport.php",results = results,user=user)

 # admin codes - setting ###############################################################   
@app.route("/admin_setting")
def admin_setting():
    user = session.get('user')
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("SELECT * FROM certformat ")
    results = cursor.fetchall()
    cursor.close()
    connection.close()

    return render_template("admin_setting.php",user=user,results = results)

@app.route('/update_admin_setting_saveCert',methods=['POST','GET'])
def update_admin_setting_saveCert():
    if request.method == 'POST':
        user = session.get('user')
        certId = request.form['certId']
        certificate = request.files['certificate']

        image_path = os.path.join('static/webimg', certificate.filename)
        certificate.save(image_path)

        connection = get_db_connection()
        cursor = connection.cursor()
        cursor.execute("""
            UPDATE certformat SET image=%s where certId = %s
        """,                (certificate.filename,certId))

        cursor.execute("INSERT INTO activity_log (userid, userType, Name, activity, date) VALUES (%s, %s, %s,%s, %s)", (user['userid'], user['userType'], user['username'], 'Update Certificate', current_datetime))

        connection.commit()
        cursor.close()
        connection.close()
        flash('Certificate Format updated successfully!')
        return redirect(url_for('admin_setting'))
    
#---------------------------------
@app.route('/get_barangay')
def get_barangay():
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("SELECT DISTINCT barangay FROM users")
    barangays = cursor.fetchall()
    cursor.close()
    connection.close()
    return jsonify(barangays)

@app.route('/get_username/<barangay>')
def get_username(barangay):
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("SELECT userid, username FROM users WHERE barangay = %s", (barangay,))
    users = cursor.fetchall()
    cursor.close()
    connection.close()
    return jsonify(users)

@app.route('/api/reset-password', methods=['POST'])
def reset_password():
    user = session.get('user')
    userid = request.args.get('userid')
    conn = get_db_connection()
    cursor = conn.cursor()
    cursor.execute("SELECT username FROM users WHERE userid = %s", (userid,))
    username = cursor.fetchone()[0]
    new_password = hashlib.md5(username.encode()).hexdigest()
    cursor.execute("UPDATE users SET password = %s WHERE userid = %s", (new_password, userid))
    cursor.execute("INSERT INTO activity_log (userid, userType, Name, activity, date) VALUES (%s, %s, %s,%s, %s)", (user['userid'], user['userType'], user['username'], 'Reset Password', current_datetime))
    conn.commit()
    cursor.close()
    conn.close()
    return jsonify({'message': 'Password reset successfully!'})

@app.route('/api/change-password', methods=['POST'])
def change_password():
    user = session.get('user')
    data = request.get_json()
    userid = data['userid']
    old_password = hashlib.md5(data['oldPassword'].encode()).hexdigest()
    new_password = hashlib.md5(data['newPassword'].encode()).hexdigest()

    conn = get_db_connection()
    cursor = conn.cursor()
    cursor.execute("SELECT password FROM users WHERE userid = %s", (userid,))
    current_password = cursor.fetchone()[0]

    if current_password != old_password:
        return jsonify({'message': 'Old password is incorrect!'}), 400

    cursor.execute("UPDATE users SET password = %s WHERE userid = %s", (new_password, userid))
    cursor.execute("INSERT INTO activity_log (userid, userType, Name, activity, date) VALUES (%s, %s, %s,%s, %s)", (user['userid'], user['userType'], user['username'], 'Change user Password', current_datetime))
    conn.commit()
    cursor.close()
    conn.close()
    return jsonify({'message': 'Password changed successfully!'})
    #return render_template('setting.html'), jsonify({'message': 'Password changed successfully!'})


# instructor codes ###############################################################

@app.route("/instructor_dashboard")
def instructor_dashboard():
    user = session.get('user')
    connection = get_db_connection()
    cursor = connection.cursor()

    cursor.execute("SELECT COUNT(*) AS total_enrollee FROM enrollee where isStudent = 'enrollee' AND branch  = %s", (user['barangay'],))
    enrollee = cursor.fetchone()
    enrollee_count = enrollee[0]

    cursor.execute("SELECT COUNT(*) AS total_student FROM student where isStudent = 'Student' AND branch  = %s", (user['barangay'],))
    student = cursor.fetchone()
    student_count = student[0]

    cursor.execute("SELECT COUNT(*) AS total_class FROM schedule where status = 'Open' AND userid  = %s", (user['userid'],))
    classs = cursor.fetchone()
    classs_count = classs[0]

    cursor.execute("SELECT COUNT(*) AS total_males FROM student WHERE sex = 'Male' AND branch  = %s", (user['barangay'],))
    male = cursor.fetchone()
    male_count = male[0]

    cursor.execute("SELECT COUNT(*) AS total_males FROM student WHERE sex = 'female' AND branch  = %s", (user['barangay'],))
    female = cursor.fetchone()
    female_count = female[0]

    cursor.execute("SELECT COUNT(*) AS total_teenager FROM student WHERE age <= 20 AND branch  = %s", (user['barangay'],))
    teen = cursor.fetchone()
    teen_count = teen[0]

    cursor.execute("SELECT COUNT(*) AS total_senior FROM student WHERE age >= 60 AND branch  = %s", (user['barangay'],))
    senior = cursor.fetchone()
    senior_count = senior[0]

    cursor.execute("SELECT * FROM announcement")
    announcement = cursor.fetchall()
    senior_count = senior[0]

    cursor.close()
    connection.close()

    return render_template("instructor_dashboard.php",user=user,male=male_count,female = female_count,teen = teen_count,senior = senior_count,classs = classs_count,student = student_count,enrollee= enrollee_count,announcement=announcement )

# display data from student table ##################################################################
@app.route('/instructor_search_manageStudentTable', methods=['GET', 'POST'])
def instructor_search_manageStudentTable():
    user = session.get('user')
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("SELECT * FROM student WHERE isStudent= 'Student' AND branch = %s", (user['barangay'],))
    results = cursor.fetchall()
    cursor.execute("SELECT DISTINCT courseTitle FROM course")
    title = cursor.fetchall()
    cursor.close()
    connection.close()

    if request.method == 'POST':
        sem = request.form['sem']
        courseID = request.form['course']
        
        # Fetching data from the database
        connection = get_db_connection()
        cursor = connection.cursor()
        cursor.execute("SELECT recommend FROM student WHERE branch=%s AND sem=%s AND courseID=%s AND batch=%s", 
                       (user['barangay'], sem, courseID, current_year))
        result = cursor.fetchall()
        cursor.close()
        connection.close()

        # Counting topics
        topics = []
        for (recommend,) in result:
            if recommend != "good":
                topics.extend(recommend.split(','))

        topic_count = Counter(topics)
        total_count = sum(topic_count.values())
        topic_percentages = {topic: (count / total_count) * 100 for topic, count in topic_count.items()}

        return render_template('instructor_manageStudentTable.php', topic_percentages=json.dumps(topic_percentages), user=user,results=results,title = title)

    return render_template('instructor_manageStudentTable.php', topic_percentages=None, user=user,results=results,title = title)


# instructor - updating student info ###############################################################

@app.route('/update_instructor_manageStudentTable',methods=['POST','GET'])
def update_instructor_manageStudentTable():
    if request.method == 'POST':
        user = session.get('user')
        studentId = request.form['studentId']
        lastName = request.form['lastName']
        firstName = request.form['firstName']
        middleName = request.form['middleName']
        suffix = request.form['suffix']
        dob = request.form['dob']
        age = request.form['age']
        sex = request.form['sex']
        status = request.form['status']
        cellphone = request.form['cellphone']
        email = request.form['email']
        educationalAttainment = request.form['educationalAttainment']
        barangay = request.form['barangay']
        district = request.form['district']
        province = request.form['province']
        completeAddress = request.form['completeAddress']
        isStudent = request.form['isStudent']   

        connection = get_db_connection()
        cursor = connection.cursor()
        cursor.execute("""
            UPDATE student SET firstname =%s,middlename=%s,lastname=%s,suffix=%s,dob=%s,age=%s,sex=%s, status=%s,email=%s,contact=%s,educational=%s,       barangay=%s,district=%s,province=%s,completeAddress=%s,isStudent=%s where studentId = %s
        """,                   (firstName,   middleName,   lastName,    suffix,   dob,   age,   sex,    status,  email,  cellphone,   educationalAttainment,barangay,   district,   province,   completeAddress,   isStudent,         studentId))
        cursor.execute("INSERT INTO activity_log (userid, userType, Name, activity, date) VALUES (%s, %s, %s,%s, %s)", (user['userid'], user['userType'], user['username'], 'Edit Student Status', current_datetime))
        connection.commit()
        cursor.close()
        connection.close()

        flash("Student Data is Updated !")
        return redirect(url_for('instructor_search_manageStudentTable'))

# instructor - display data from enrollees and insert data from enrollee to student table ################

@app.route("/instructor_manageEnrollees")
def instructor_manageEnrollees():
    user = session.get('user')
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("SELECT * FROM enrollee WHERE isStudent = 'Enrollee' AND branch = %s ORDER BY enrolleeId DESC",(user['barangay'],))
    results = cursor.fetchall()
    cursor.close()
    connection.close()
    return render_template("instructor_manageEnrollees.php",results = results,user=user)

@app.route("/insert_instructor_manageStudent/<string:id_data>", methods = ['GET'])
def insert_instructor_dashboard(id_data):
    user = session.get('user')
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("INSERT INTO student (branch,sem,courseId,time,firstname,middlename,lastname,suffix,dob,age,sex,status,email,contact,educational,barangay,district,province,completeAddress,score,recommend,batch,isStudent) SELECT branch,sem,courseId,time,firstname,middlename,lastname,suffix,dob,age,sex,status,email,contact,educational,barangay,district,province,completeAddress,score,recommend,batch,'Student' FROM enrollee WHERE enrolleeId=%s", (id_data,))
    cursor.execute("""
        UPDATE enrollee
        SET isStudent = 'Student'
        WHERE enrolleeId = %s
    """, (id_data,))

    cursor.execute("INSERT INTO activity_log (userid, userType, Name, activity, date) VALUES (%s, %s, %s,%s, %s)", (user['userid'], user['userType'], user['username'], 'Accept Student Application', current_datetime))
    connection.commit()
    cursor.close()
    connection.close()
    flash("Student Added to the Record !")
    return redirect(url_for('instructor_manageEnrollees'))

# display,insert and updating schedule ######################################################################

@app.route("/instructor_schedule")
def instructor_schedule():
    user = session.get('user')
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("SELECT  * FROM schedule where userid = %s",(user['userid'],))
    results = cursor.fetchall()
    cursor.close()
    connection.close()

    return render_template("instructor_schedule.php",results = results,user=user)

@app.route('/get_course_titles', methods=['GET'])
def get_course_titles():
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("SELECT courseId, courseTitle FROM course")
    courses = cursor.fetchall()
    cursor.close()
    connection.close()
    
    return jsonify(courses)


@app.route('/insert_instructor_schedule',methods=['POST','GET'])
def insert_instructor_schedule():
    user = session.get('user')
    if request.method == 'POST':
        userid = request.form['userid']
        courseId = request.form['courseId']
        courseTitle= request.form['courseTitle']
        time = request.form['time']
        day = request.form['day']
        sem = request.form['sem']
        status = request.form['status']

        connection = get_db_connection()
        cursor = connection.cursor()
        cursor.execute("INSERT INTO schedule (userid,courseId,courseTitle,time,day,sem,status) VALUES (%s, %s, %s,%s, %s,%s, %s)", (userid ,courseId,courseTitle,time,day,sem,status))
        cursor.execute("INSERT INTO activity_log (userid, userType, Name, activity, date) VALUES (%s, %s, %s,%s, %s)", (user['userid'], user['userType'], user['username'], 'Add Schedule', current_datetime))
        connection.commit()
        cursor.close()
        connection.close()
        flash("New Schedule is Added !")
        return redirect(url_for('instructor_schedule'))


@app.route('/update_instructor_schedule',methods=['POST','GET'])
def update_instructor_schedule():
    user = session.get('user')
    if request.method == 'POST':
        schedId = request.form['schedId']
        time = request.form['time']
        day = request.form['day']
        sem = request.form['sem']
        status = request.form['status']

        connection = get_db_connection()
        cursor = connection.cursor()
        cursor.execute("""
            UPDATE schedule SET time =%s, day=%s, sem=%s, status=%s where schedId = %s
        """,(time,day,sem,status,schedId))
        cursor.execute("INSERT INTO activity_log (userid, userType, Name, activity, date) VALUES (%s, %s, %s,%s, %s)", (user['userid'], user['userType'], user['username'], 'Update Schedule', current_datetime))

        connection.commit()
        cursor.close()
        connection.close()
        flash("Schedule is Updated!")
        return redirect(url_for('instructor_schedule'))
       
# displaying exams ############################################################

@app.route("/instructor_exam")
def instructor_exam():
    user = session.get('user')
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("SELECT * FROM questions")
    results = cursor.fetchall()
    cursor.close()
    connection.close()
    return render_template("instructor_exam.php",results = results,user=user)

@app.route('/insert_instructor_exam',methods=['POST','GET'])
def insert_instructor_exam():
    user = session.get('user')
    if request.method == 'POST':
       question = request.form['question']
       
       connection = get_db_connection()
       cursor = connection.cursor()
       cursor.execute("INSERT INTO questions (question) VALUES (%s)", (question,))
       

       cursor.execute("INSERT INTO activity_log (userid, userType, Name, activity, date) VALUES (%s, %s, %s,%s, %s)", (user['userid'], user['userType'], user['username'], 'Create Question', current_datetime))
       connection.commit()

       cursor.close()
       connection.close()
    return redirect(url_for('instructor_exam'))

@app.route('/delete_instructor_exam/<int:questionId>')
def delete_instructor_exam(questionId):
       user = session.get('user')
       connection = get_db_connection()
       cursor = connection.cursor()
       cursor.execute("DELETE FROM questions WHERE questionId = %s", (questionId,))
      

       cursor.execute("INSERT INTO activity_log (userid, userType, Name, activity, date) VALUES (%s, %s, %s,%s, %s)", (user['userid'], user['userType'], user['username'], 'Delete Question', current_datetime))
       connection.commit()

       cursor.close()
       connection.close()

       return redirect(url_for('instructor_exam'))

# for certificates ############################################################
@app.route('/instructor_certificate', methods=['GET', 'POST'])
def instructor_certificate():
    user = session.get('user')
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("SELECT DISTINCT courseTitle FROM course")
    title = cursor.fetchall()
    cursor.close()
    connection.close()
    
    return render_template('instructor_certificate.php', user=user,title = title)

@app.route('/instructor_search_certificate', methods=['GET', 'POST'])
def instructor_search_certificate():
 if request.method == 'POST':
        user = session.get('user')
        batch = request.form['batch']
        courseID = request.form['course']
        
        # Fetching data from the database
        connection = get_db_connection()
        cursor = connection.cursor()
        cursor.execute("SELECT * FROM student WHERE isStudent= 'Graduate' AND branch=%s AND courseID=%s AND batch=%s", 
                       (user['barangay'], courseID, batch))
        results = cursor.fetchall()
        cursor.execute('SELECT * FROM certformat')
        certs = cursor.fetchall()
        cursor.close()
        connection.close()

        return render_template('instructor_certificate.php', user=user,results=results,certs = certs)
    

# for reports ############################################################
@app.route("/instructor_manageReport")
def instructor_manageReport():
    user = session.get('user')
    return render_template("instructor_manageReport.php",user=user)

@app.route('/get_course')
def get_course():
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("SELECT DISTINCT courseId FROM student")
    courseId = cursor.fetchall()
    cursor.close()
    connection.close()
    return jsonify(courseId)

@app.route('/search_instructor_manageReport',methods=['POST','GET'])
def search_instructor_manageReport():
    user = session.get('user')
    if request.method == 'POST':
        course = request.form['course']
        sem = request.form['sem']
        status = request.form['status']

        connection = get_db_connection()
        cursor = connection.cursor()
        cursor.execute("SELECT * FROM student WHERE courseId = %s AND sem = %s AND isStudent = %s AND branch = %s AND batch = %s ", (course,sem,status,user['barangay'],current_datetime))
        results = cursor.fetchall()
        connection.commit()
        cursor.close()
        connection.close()
       
        #return redirect(url_for('instructor_manageReport',results = results))
        return render_template("instructor_manageReport.php",results = results,user=user)
       
    

# log out structure ###############################################

@app.route("/bclp_logout")
def logout():
    user = session.get('user')
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("INSERT INTO activity_log (userid, userType, Name, activity, date) VALUES (%s, %s, %s,%s, %s)", (user['userid'], user['userType'], user['username'], 'Log-Out', current_datetime))
    connection.commit()
    cursor.close()
    connection.close()
    
    return redirect(url_for('login'))

if __name__ == "__main__":
    app.run(debug=True) 
