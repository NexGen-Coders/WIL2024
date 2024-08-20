from flask import Flask, request, render_template, redirect, url_for, flash
import os

app = Flask(__name__)
app.secret_key = 'your_secret_key'

# Path to the text file storing user credentials
CREDENTIALS_FILE = 'credentials.txt'

def load_credentials():
    credentials = {}
    if os.path.exists(CREDENTIALS_FILE):
        with open(CREDENTIALS_FILE, 'r') as file:
            for line in file:
                username, email, password = line.strip().split(',')
                credentials[username] = {'email': email, 'password': password}
    return credentials

def save_credentials(username, email, password):
    with open(CREDENTIALS_FILE, 'a') as file:
        file.write(f'{username},{email},{password}\n')

@app.route('/')
def home():
    return render_template('index.html')

@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        username = request.form['username']
        password = request.form['password']
        credentials = load_credentials()

        if username in credentials and credentials[username]['password'] == password:
            flash('Login successful!', 'success')
            return redirect(url_for('home'))
        else:
            flash('Invalid username or password', 'danger')
    return render_template('login.html')

@app.route('/signup', methods=['GET', 'POST'])
def signup():
    if request.method == 'POST':
        username = request.form['username']
        email = request.form['email']
        password = request.form['password']
        credentials = load_credentials()

        if username in credentials:
            flash('Username already exists', 'danger')
        else:
            save_credentials(username, email, password)
            flash('Registration successful!', 'success')
            return redirect(url_for('login'))
    return render_template('signup.html')

if __name__ == '__main__':
    app.run(debug=True)
