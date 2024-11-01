import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestClassifier
import numpy as np
import random

df = pd.read_csv('students_data.csv')

    # Preprocess data
df['Gender'] = df['Gender'].map({'Male': 0, 'Female': 1})
X = df[['Age', 'Gender', 'Score']]
y = df['Churn']

    # Split dataset
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

    # Train model
model = RandomForestClassifier()
model.fit(X_train, y_train)

def churn_prediction(gender,age,total_yes,totalItemTest,course):
# Load dataset
   
        
    # Predict churn
    user_input = np.array([[age, 0 if gender == 'Male' else 1, total_yes]])
    churn_prediction = model.predict(user_input)
    # Calculate score percentage
    total_questions = int(totalItemTest )
    score_percentage = (total_yes / total_questions) * 100
    # Recommend topics
    topics = {
            'CRS01': ['Excel Formulas', 'PowerPoint Design', 'Word Formatting', 'Data Analysis', 'Macros','Charts','Windows History','Understanding Windows','Spread Sheets'],
            'CRS02': ['Layer Management', 'Color Correction', 'Photo Retouching', 'Text Effects', 'Filters','Toolbox','Layer Masking','Image Effects'],
            'CRS03': ['HTML Basics', 'CSS Styling', 'JavaScript Basics', 'Responsive Design', 'SEO Basics','CSS Properties','Attributes','Website Structure','Links and Navigation']
            }
    if churn_prediction[0]== 1:
        # and score_percentage >= 77:
    # Recommend topics based on score
    
            if score_percentage <= 35:
                recommended_topics = random.sample(topics[course], 4)
            elif score_percentage <= 50:
                recommended_topics = random.sample(topics[course], 3)
            elif score_percentage <= 75:
                recommended_topics = random.sample(topics[course], 2)
            else:
                recommended_topics = random.sample(topics[course], 1)
    else:
        recommended_topics = ("Good")


    # Print the results
    return round(score_percentage,2),recommended_topics
