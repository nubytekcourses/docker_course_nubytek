from flask import Flask, jsonify

app = Flask(__name__)

@app.route('/status')
def status():
    return jsonify({"status": "UP", "message": "User service is running."})

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)