import pandas as pd
from sklearn.ensemble import RandomForestClassifier
from sklearn.model_selection import train_test_split

# Load the dataset (you can use a CSV file or create a sample dataset)
data = {
    'question1': [1, 1, 0, 1, 0, 0, 1, 1, 0, 0],
    'question2': [1, 0, 1, 1, 0, 1, 0, 0, 1, 1],
    'question3': [0, 1, 1, 0, 1, 0, 1, 1, 0, 0],
    'question4': [1, 1, 0, 0, 1, 1, 0, 0, 1, 1],
    'question5': [0, 0, 1, 1, 0, 0, 1, 1, 0, 0],
    'skill1': [1, 0, 1, 1, 0, 0, 1, 0, 1, 0],
    'skill2': [0, 1, 0, 0, 1, 1, 0, 1, 0, 1],
    'skill3': [1, 0, 1, 0, 0, 1, 1, 0, 1, 0]
}

df = pd.DataFrame(data)

# Define the features (questions) and target (skills)
X = df[['question1', 'question2', 'question3', 'question4', 'question5']]
y = df[['skill1', 'skill2', 'skill3']]

# Split the data into training and testing sets
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Create a Random Forest classifier
rf = RandomForestClassifier(n_estimators=100, random_state=42)

# Train the model
rf.fit(X_train, y_train)

# Define a function to get user input and predict skills
def get_skills():
    user_input = []
    for i in range(5):
        question = f"Question {i+1} (yes/no): "
        answer = input(question)
        if answer.lower() == 'yes':
            user_input.append(1)
        else:
            user_input.append(0)
    
    # Convert user input to a pandas dataframe
    user_input_df = pd.DataFrame([user_input], columns=X.columns)
    
    # Predict skills
    prediction = rf.predict(user_input_df)
    
    # Get the skills that need improvement
    skills_to_improve = []
    for i, skill in enumerate(prediction[0]):
        if skill == 0:
            skills_to_improve.append(f"Skill {i+1}")
    
    return skills_to_improve

# Run the application
print("Welcome to the skills assessment application!")
print("Please answer the following questions with 'yes' or 'no':")
skills_to_improve = get_skills()
print("Based on your answers, you may need to improve the following skills:")
for skill in skills_to_improve:
    print(skill)