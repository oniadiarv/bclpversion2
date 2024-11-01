import pandas as pd
from sklearn.ensemble import RandomForestClassifier
import sqlite3

# Connect to the database
conn = sqlite3.connect("students.db")
cursor = conn.cursor()

# Create a table to store the student data
cursor.execute("""
    CREATE TABLE IF NOT EXISTS students (
        id INTEGER PRIMARY KEY,
        male INTEGER,
        over_17 INTEGER,
        failed_class INTEGER,
        absent_more_than_5 INTEGER,
        special_ed INTEGER,
        dropout INTEGER
    );
""")

# Insert the training data into the table
training_data = [
    (1, 1, 0, 1, 1, 0, 1),
    (2, 0, 1, 0, 0, 0, 0),
    (3, 1, 0, 1, 1, 0, 1),
    (4, 0, 1, 0, 0, 0, 0),
    (5, 1, 0, 1, 1, 0, 1),
    (6, 0, 1, 0, 0, 0, 0),
    (7, 1, 0, 1, 1, 0, 1),
    (8, 0, 1, 0, 0, 0, 0)
]
cursor.executemany("INSERT INTO students VALUES (?,?,?,?,?,?,?)", training_data)
conn.commit()

# Define the random forest model
rf_model = RandomForestClassifier(n_estimators=100, random_state=42)

# Load the training data from the database
cursor.execute("SELECT * FROM students")
training_df = pd.DataFrame(cursor.fetchall(), columns=["id", "male", "over_17", "failed_class", "absent_more_than_5", "special_ed", "dropout"])

# Define the feature columns
X = training_df[["male", "over_17", "failed_class", "absent_more_than_5", "special_ed"]]
y = training_df["dropout"]

# Train the random forest model
rf_model.fit(X, y)

# Define the yes/no questions and their corresponding features
questions = [
    {"question": "Is the student male?", "feature": "male"},
    {"question": "Is the student over 17?", "feature": "over_17"},
    {"question": "Has the student failed a class?", "feature": "failed_class"},
    {"question": "Has the student been absent more than 5 times?", "feature": "absent_more_than_5"},
    {"question": "Is the student in a special education program?", "feature": "special_ed"}
]

# Get the answers to the yes/no questions for the new student
new_student_answers = []
for question in questions:
    answer = input(question["question"] + " (yes/no): ")
    if answer.lower() == "yes":
        new_student_answers.append(1)
    else:
        new_student_answers.append(0)

# Create a feature vector for the new student
new_student_feature_vector = new_student_answers

# Predict the dropout possibility of the new student
prediction = rf_model.predict_proba([new_student_feature_vector])[:, 1]

print("Dropout possibility:", prediction[0])

# Close the database connection
conn.close()