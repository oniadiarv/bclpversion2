from flask import Flask, render_template, request, redirect, url_for,jsonify,session, flash
import hashlib
import mysql.connector
import churn as ch
import json 
import datetime
import os

# Get the current date and time
current_datetime = datetime.datetime.now()


# Extract the current year
current_year = current_datetime.year

app = Flask(__name__)
app.secret_key = 'your_secret_key'

 
# Database connection
def get_db_connection():
    connection = mysql.connector.connect(
 # host='o3iyl77734b9n3tg.cbetxkdyhwsb.us-east-1.rds.amazonaws.com',
       # user='mb08xvujtl5y5ks3',  # Default XAMPP username
       # password='trnq84lpad70qxa1',  # Default XAMPP password
       # database='maouhppvyslx9wyi' 

        host='localhost',
        user='root',  # Default XAMPP username
        password='',  # Default XAMPP password
        database='bclp_db'  
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
    cursor.execute("SELECT DISTINCT barangay FROM users where userType = 'Instructor'")
    barangays = cursor.fetchall()
    cursor.close()
    connection.close()
    return jsonify(barangays)

@app.route('/get_courses/<barangay>')
def get_courses(barangay):
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("SELECT DISTINCT c.courseId, c.courseTitle FROM course c JOIN schedule s ON c.courseId = s.courseId JOIN users u ON s.userid = u.userid WHERE u.barangay = %s AND status = 'Open'", (barangay,))
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

    cursor.close()
    connection.close()

    return render_template("admin_dashboard.php",user=user,male=male_count,female = female_count)

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
    cursor.execute("SELECT * FROM activity_log ")
    results = cursor.fetchall()
    cursor.close()
    connection.close()

    return render_template("admin_auditTrail.php",results=results,user=user)

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

    cursor.close()
    connection.close()

    return render_template("instructor_dashboard.php",user=user,male=male_count,female = female_count,teen = teen_count,senior = senior_count,classs = classs_count,student = student_count,enrollee= enrollee_count)

# display data from student table ##################################################################
@app.route("/instructor_manageStudentTable")
def instructor_manageStudentTable():
    user = session.get('user')
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("SELECT * FROM student WHERE isStudent= 'Student' AND branch = %s",(user['barangay'],))
    results = cursor.fetchall()
    cursor.close()
    connection.close()

    return render_template("instructor_manageStudentTable.php",results = results,user=user)

# instructor - updating student info ###############################################################

@app.route('/update_instructor_manageStudentTable',methods=['POST','GET'])
def update_instructor_manageStudentTable():
    if request.method == 'POST':
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

        connection.commit()
        cursor.close()
        connection.close()

        return redirect(url_for('instructor_manageStudentTable'))

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
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("INSERT INTO student (branch,sem,courseId,time,firstname,middlename,lastname,suffix,dob,age,sex,status,email,contact,educational,barangay,district,province,completeAddress,score,recommend,batch,isStudent) SELECT branch,sem,courseId,time,firstname,middlename,lastname,suffix,dob,age,sex,status,email,contact,educational,barangay,district,province,completeAddress,score,recommend,batch,'Student' FROM enrollee WHERE enrolleeId=%s", (id_data,))
    cursor.execute("""
        UPDATE enrollee
        SET isStudent = 'Student'
        WHERE enrolleeId = %s
    """, (id_data,))
    connection.commit()
    cursor.close()
    connection.close()
    
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
        connection.commit()
        cursor.close()
        connection.close()
        flash("New Schedule is Added !")
        return redirect(url_for('instructor_schedule'))


@app.route('/update_instructor_schedule',methods=['POST','GET'])
def update_instructor_schedule():
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

# for reports ############################################################
@app.route("/instructor_manageReport")
def nstructor_manageReport():
    user = session.get('user')
    return render_template("instructor_manageReport.php",user=user)
    

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


                  

                    
                   
               
