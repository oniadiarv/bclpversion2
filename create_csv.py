import pandas as pd
import random

# Constants
num_rows = 1000
ages = list(range(18, 71))
genders = ['Male', 'Female']
educational_backgrounds = ['Elementary', 'High School', 'College']
courses = ['CRS01', 'CRS02', 'CRS03']
total_questions = [10,16,22]

# Function to generate topics based on churn and score
def generate_topics(churn, score, course):
    topics = {
        'CRS01': ['Excel Formulas', 'PowerPoint Design', 'Word Formatting', 'Data Analysis', 'Macros','Charts','Windows History','Understanding Windows','Spread Sheets'],
        'CRS02': ['Layer Management', 'Color Correction', 'Photo Retouching', 'Text Effects', 'Filters','Toolbox','Layer Masking','Image Effects'],
        'CRS03': ['HTML Basics', 'CSS Styling', 'JavaScript Basics', 'Responsive Design', 'SEO Basics','CSS Properties','Attributes','Website Structure','Links and Navigation']
    }
    if churn == 1:
        if score <= 30:
            return random.sample(topics[course], 4)
        elif score <= 40:
            return random.sample(topics[course], 3)
        else:
            return random.sample(topics[course], 2)
    return []

# Generate dataset
data = []
for i in range(num_rows):
    item_number = i + 1
    age = random.choice(ages)
    gender = random.choice(genders)
    educational_background = random.choice(educational_backgrounds)
    course = random.choice(courses)
    total_question = random.choice(total_questions)
    score = random.randint(1,11)
    churn = random.choice([0, 1])
    topics_to_enhance = generate_topics(churn, score, course)
    
    data.append([item_number, age, gender, educational_background, course, total_question, score, churn, topics_to_enhance])

# Create DataFrame and save as CSV
df = pd.DataFrame(data, columns=['Item Number', 'Age', 'Gender', 'Educational Background', 'Course', 'Total Questions', 'Score', 'Churn', 'Topics to Enhance'])
df.to_csv('students_data.csv', index=False)
