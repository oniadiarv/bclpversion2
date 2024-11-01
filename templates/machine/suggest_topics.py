from flask import Flask, request, jsonify
import pandas as pd

# Sample dataset creation
data = {
    'Name': ['Alice', 'Bob', 'Charlie', 'David'],
    'Age': [22, 23, 21, 24],
    'Educational Attainment': ['Bachelor', 'Bachelor', 'Associate', 'Bachelor'],
    'Choice Course': ['Photoshop', 'Web Design', 'Microsoft Office', 'Photoshop'],
    'Assessment Score': [75, 85, 65, 65],
    'Weak Topics': [
        ['Layer Management', 'Color Correction'],  # Photoshop
        ['HTML Basics', 'CSS Flexbox'],            # Web Design
        ['Excel Formulas', 'PowerPoint Design'],    # Microsoft Office
        ['Selection Tools', 'Filters']               # Photoshop
    ]
}

applicant_data = pd.DataFrame(data)
print(applicant_data)

app = Flask(__name__)

@app.route('/process_data', methods=['POST'])
def process_data():
    name = request.form.get('name')
    age = request.form.get('age')
    educational_attainment = request.form.get('educational')
    email = request.form.get('email')
    choice_course = request.form.get('course')
    assessment_score = request.form.get('score')

    

       # Process the data (for example, create a response)
    response = f"Received data - Name: {name}, Age: {age}, Educational Attainment: {educational_attainment} Email: {email}, Course: {choice_course}, Score: {assessment_score}"
    
    return response

    
def recommend_weak_topics(applicant_info, dataset):
    course = applicant_info['Choice Course']
    score = applicant_info['Assessment Score']
    
    # Find the corresponding weak topics based on the chosen course
    weak_topics = dataset.loc[dataset['Choice Course'] == course, 'Weak Topics'].values[0]
    
    # Recommend topics based on score
    if score < 70:
        return weak_topics
    else:
        return ["No weak topics identified. Keep up the good work!"]

def main():
    # Collect applicant information
    applicant_info = process_data()
    
    # Recommend weak topics
    weak_topics = recommend_weak_topics(applicant_info, applicant_data)
    
    # Display the results
    print(f"\nHello based on your assessment score, we recommend you focus on the following topics:")
    for topic in weak_topics:
        print(f"- {topic}")

if __name__ == '__main__':
    app.run(port=5000)
