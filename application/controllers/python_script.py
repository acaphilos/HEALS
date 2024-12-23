import sys

# Retrieve input data from command-line arguments

# input_data = 'shivering','joint_pain'

selected_values = sys.argv[1]
input_data = selected_values.split(",")

#install
#pip install pandas
#pip install scikit-learn

# import
import pandas as pd
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.metrics import accuracy_score, confusion_matrix
from sklearn.naive_bayes import MultinomialNB  # For Multinomial Naive Bayes (for discrete features)


# Read the CSV file and create a DataFrame
df2 = pd.read_csv('C:/Users/Asyraaf/Downloads/Documents/UMS/Jupyter notebooks/processed_data2.csv')

# # After selecting features

# Split the dataset into features (X) and target (y)
x_train2 = df2.drop(columns=['prognosis'])  # Replace 'target_column' with the name of your target variable
y_train2 = df2['prognosis']

# Split the dataset into training and testing sets
x_train2, x_test2, y_train2, y_test2 = train_test_split(x_train2, y_train2, test_size=0.3, random_state=42)

# In[148]:

nb2 = MultinomialNB()

# Train the model
nb2.fit(x_train2, y_train2)  # For classification

# Make predictions (optional)
y_pred_nb2 = nb2.predict(x_test2)  # For classification

# Assuming df is your original DataFrame with 132 features
# Replace 'feature1' and 'feature2' with the actual names of the features you want to set to 1.
features_to_set_2 = input_data

# Create a new DataFrame with 132 features, all initialized to 0
new_instance2 = pd.DataFrame(0, columns=df2.columns, index=[0])

# Set the values of 'feature1' and 'feature2' to 1
new_instance2.loc[0, features_to_set_2] = 1

# Split the dataset into features (X) and target (y)
new_instance2 = new_instance2.drop(columns=['prognosis'])  # Replace 'target_column' with the name of your target variable

# single output
#result = nb2.predict(new_instance2)

class_probabilities  = nb2.predict_proba(new_instance2)

# Extract class labels and their corresponding probabilities
class_labels = nb2.classes_
probabilities = class_probabilities[0]

# Sort class probabilities in descending order and get the top three classes
top_three_indices = np.argsort(probabilities)[::-1][:3]
top_three_classes = class_labels[top_three_indices]
top_three_probabilities = probabilities[top_three_indices]

result = ', '.join(top_three_classes)
print(result)
