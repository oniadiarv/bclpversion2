import pandas as pd

# Sample dataset creation
data = {
    'Name': ['Alice', 'Bob', 'Charlie', 'David', 'Eva'],
    'Age': [25, 30, 22, 35, 28],
    'Assessment_Score': [85, 70, 90, 60, 75],
    'Educational_Attainment': ['Bachelor', 'Master', 'Bachelor', 'PhD', 'Associate'],
    'Course': ['Photoshop', 'Web Design', 'Microsoft', 'Photoshop', 'Web Design'],
    'Topics_Needing_Improvement': [
        ['Layer Management', 'Color Correction'],
        ['Responsive Design', 'JavaScript Basics'],
        ['Excel Functions', 'PowerPoint Design'],
        ['Advanced Techniques', 'Portfolio Development'],
        ['HTML Basics', 'CSS Flexbox']
    ]
}

# Creating a DataFrame
df = pd.DataFrame(data)
print(df)

def get_user_input():
    name = input("Enter your name: ")
    age = int(input("Enter your age: "))
    assessment_score = int(input("Enter your assessment score (0-100): "))
    educational_attainment = input("Enter your educational attainment (e.g., Bachelor, Master): ")
    course = input("Choose a course (Photoshop, Web Design, Microsoft): ")
    
    return {
        'Name': name,
        'Age': age,
        'Assessment_Score': assessment_score,
        'Educational_Attainment': educational_attainment,
        'Course': course
    }

from sklearn.model_selection import train_test_split
from sklearn.tree import DecisionTreeClassifier
from sklearn.preprocessing import LabelEncoder

# Preparing the data for the model
X = df[['Age', 'Assessment_Score']]
y = df['Topics_Needing_Improvement'].apply(lambda x: ', '.join(x))

# Encoding categorical data
label_encoder = LabelEncoder()
y_encoded = label_encoder.fit_transform(y)

# Splitting the dataset
X_train, X_test, y_train, y_test = train_test_split(X, y_encoded, test_size=0.2, random_state=42)

# Training the model
model = DecisionTreeClassifier()
model.fit(X_train, y_train)

def predict_topics(user_data):
    user_df = pd.DataFrame([user_data])
    prediction = model.predict(user_df[['Age', 'Assessment_Score']])
    return label_encoder.inverse_transform(prediction)[0]

# Example of using the function
user_data = get_user_input()
predicted_topics = predict_topics(user_data)
print(f"Recommended topics to improve: {predicted_topics}")


