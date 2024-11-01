def collect_user_info():
    name = input("Enter your name: ")
    age = int(input("Enter your age: "))
    educational_attainment = input("Enter your educational attainment: ")
    course = input("Choose a course (Adobe, Web Design, Microsoft): ")
    
    return name, age, educational_attainment, course

def ask_yes_no_questions():
    questions = [
        "Do you have experience with graphic design? (yes/no)",
        "Are you familiar with HTML and CSS? (yes/no)",
        "Have you used Microsoft Office applications? (yes/no)",
        "Do you have a portfolio of your work? (yes/no)",
        "Are you comfortable working in a team? (yes/no)"
    ]
    
    yes_count = 0
    
    for question in questions:
        answer = input(question).strip().lower()
        if answer == 'yes':
            yes_count += 1
            
    return yes_count

import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestClassifier

# Sample dataset
data = {
    'experience_graphic_design': [1, 0, 1, 0, 1],
    'familiarity_html_css': [1, 1, 0, 0, 1],
    'used_microsoft_office': [1, 1, 1, 0, 1],
    'portfolio': [1, 0, 1, 0, 1],
    'team_work': [1, 1, 0, 1, 1],
    'course': ['Adobe', 'Web Design', 'Microsoft', 'Adobe', 'Web Design']
}

df = pd.DataFrame(data)

# Features and target variable
X = df.drop('course', axis=1)
y = df['course']

# Splitting the dataset
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Training the model
model = RandomForestClassifier()
model.fit(X_train, y_train)

def recommend_topics(yes_count, course):
    # This function would use the trained model to recommend topics
    # For simplicity, we will return hardcoded recommendations
    recommendations = {
        'Adobe': ["Graphic Design Principles", "Photoshop Techniques"],
        'Web Design': ["HTML Basics", "CSS Styling"],
        'Microsoft': ["Excel Formulas", "PowerPoint Design"]
    }
    
    return recommendations.get(course, [])

def display_dataset():
    print("Dataset used for training:")
    print(df)

# Main function to run the system
def main():
    name, age, educational_attainment, course = collect_user_info()
    yes_count = ask_yes_no_questions()
    topics_to_improve = recommend_topics(yes_count, course)
    
    print(f"\nHello {name}, based on your course selection '{course}' and your responses, you should improve on the following topics:")
    for topic in topics_to_improve:
        print(f"- {topic}")
    
    display_dataset()

if __name__ == "__main__":
    main()
