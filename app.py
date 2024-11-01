from flask import Flask, render_template, request, redirect, url_for,jsonify

import mysql.connector
import churn as ch
import json 
import datetime

# Get the current date and time
current_datetime = datetime.datetime.now()

# Extract the current year
current_year = current_datetime.year

app = Flask(__name__)

 
# Database connection
def get_db_connection():
    connection = mysql.connector.connect(
        host='o3iyl77734b9n3tg.cbetxkdyhwsb.us-east-1.rds.amazonaws.com',
        user='mb08xvujtl5y5ks3',  # Default XAMPP username
        password='trnq84lpad70qxa1',  # Default XAMPP password
        database='maouhppvyslx9wyi'  
    )
    return connection

@app.route("/")
def bclp():
    return render_template("index.php")

@app.route('/get_barangays')
def get_barangays():
    connection = mysql.connector.connect(
        host='o3iyl77734b9n3tg.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306',
        user='mb08xvujtl5y5ks3',  # Default XAMPP username
        password='trnq84lpad70qxa1',  # Default XAMPP password
        database='maouhppvyslx9wyi'
    )
    cursor = connection.cursor()
    cursor.execute("SELECT DISTINCT barangay FROM users where userType = 'Instructor'")
    barangays = cursor.fetchall()
    cursor.close()
    connection.close()
    return jsonify(barangays)

@app.route('/get_courses/<barangay>')
def get_courses(barangay):
    connection = mysql.connector.connect(
        host='o3iyl77734b9n3tg.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306',
        user='mb08xvujtl5y5ks3',  # Default XAMPP username
        password='trnq84lpad70qxa1',  # Default XAMPP password
        database='maouhppvyslx9wyi'
    )
    cursor = connection.cursor()
    cursor.execute("SELECT DISTINCT c.courseId, c.courseTitle FROM course c JOIN schedule s ON c.courseId = s.courseId JOIN users u ON s.userid = u.userid WHERE u.barangay = %s AND status = 'Open'", (barangay,))
    courses = cursor.fetchall()
    cursor.close()
    connection.close()
    return jsonify(courses)

@app.route('/get_time/<courseId>')
def get_time(courseId):
    connection = mysql.connector.connect(
        host='o3iyl77734b9n3tg.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306',
        user='mb08xvujtl5y5ks3',  # Default XAMPP username
        password='trnq84lpad70qxa1',  # Default XAMPP password
        database='maouhppvyslx9wyi'
    )
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

################################################################
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


        return redirect(url_for('bclp'))
    
@app.route("/index")
def back():
    return bclp()
 
@app.route("/login", methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        username = request.form['username']
        password = request.form['password']
        
        # Check credentials
        if username == 'instructor' and password == '123':
            return render_template('instructor_dashboard.php')
        elif username == 'admin' and password == '123':
            return render_template('admin_dashboard.php')
        else:
            return redirect(url_for('login'))
        
    return render_template("bclp_login.php")
###############################################################
@app.route("/admin_dashboard")
def admin_dashboard():
    return render_template("admin_dashboard.php")

@app.route("/admin_addCourse")
def admin_addCourse():
    return render_template("admin_addCourse.php")

@app.route("/admin_manageuser")
def admin_manageuser():
    return render_template("admin_manageuser.php")

@app.route("/admin_auditTrail")
def admin_auditTrail():
    return render_template("admin_auditTrail.php")
################################################################
@app.route("/instructor_dashboard")
def instructor_dashboard():
    return render_template("instructor_dashboard.php")

@app.route("/instructor_manageStudentTable")
def instructor_manageStudentTable():
    return render_template("instructor_manageStudentTable.php")

@app.route("/instructor_manageEnrollees")
def instructor_manageEnrollees():
    connection = get_db_connection()
    cursor = connection.cursor()
    cursor.execute("SELECT * FROM enrollee")
    results = cursor.fetchall()
    cursor.close()
    connection.close()
    return render_template("instructor_manageEnrollees.php",results = results)

@app.route("/instructor_schedule")
def instructor_schedule():
    return render_template("instructor_schedule.php")

@app.route("/instructor_exam")
def instructor_exam():
    return render_template("instructor_exam.php")
    
@app.route("/bclp_logout")
def logout():
    return redirect(url_for('login'))

################################################################

       

if __name__ == "__main__":
    app.run(debug=True) 


                  

                    
                   
               