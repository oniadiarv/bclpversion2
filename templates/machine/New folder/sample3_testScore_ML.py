import pandas as pd
from sklearn.ensemble import RandomForestClassifier
import sqlite3

# Connect to the database
conn = sqlite3.connect("studentsScore.db")
cursor = conn.cursor()

# Create a table to store the student data
cursor.execute("""
    CREATE TABLE IF NOT EXISTS students (
        id INTEGER PRIMARY KEY,
        math_score REAL,
        reading_score REAL,
        writing_score REAL,
        dropout INTEGER
    );
""")

# Insert the training data into the table
training_data = [
    (1, 80, 70, 90, 1),
    (2, 90, 80, 70, 0),
    (3, 70, 60, 80, 1),
    (4, 95, 85, 75, 0),
    (5, 85, 75, 95, 1),
    (6, 75, 65, 85, 0),
    (7, 95, 90, 80, 1),
    (8, 80, 70, 90, 0)
]
cursor.executemany("INSERT INTO students VALUES (?,?,?,?,?)", training_data)
conn.commit()

# Define the random forest model
rf_model = RandomForestClassifier(n_estimators=100, random_state=42)

# Load the training data from the database
cursor.execute("SELECT * FROM students")
training_df = pd.DataFrame(cursor.fetchall(), columns=["id", "math_score", "reading_score", "writing_score", "dropout"])

# Define the feature columns
X = training_df[["math_score", "reading_score", "writing_score"]]
y = training_df["dropout"]

# Train the random forest model
rf_model.fit(X, y)

# Define the yes/no questions and their corresponding test scores
questions = [
    {"question": "Is the student proficient in math?", "score": "math_score"},
    {"question": "Is the student proficient in reading?", "score": "reading_score"},
    {"question": "Is the student proficient in writing?", "score": "writing_score"}
]

# Get the test scores for the new student
new_student_scores = []
for question in questions:
    score = float(input(question["question"] + " (0-100): "))
    new_student_scores.append(score)

# Create a feature vector for the new student
new_student_feature_vector = new_student_scores

# Predict the dropout possibility of the new student
prediction = rf_model.predict_proba([new_student_feature_vector])[:, 1]

print("Dropout possibility:", prediction[0])

# Close the database connection
conn.close()