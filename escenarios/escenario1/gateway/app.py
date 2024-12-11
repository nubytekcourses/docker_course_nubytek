from flask import Flask, jsonify, make_response
from flask_cors import CORS
import requests

app = Flask(__name__)

cors = CORS(app, resources={r"/foo": {"origins": "http://localhost"}})


MICROSERVICES = {
    "users": "http://users:5000",
    "payments": "http://payments:5000",
    "inventory": "http://inventory:5000"
}

@app.route("/")
def home():
    return jsonify({"message": "API Gateway is running!"})

    # response = make_response(jsonify({"message": "API Gateway is running!"}))
    # response.headers["Access-Control-Allow-Origin"] = "*"
    # return response

@app.route("/status")
def status():
    statuses = {}
    for service, url in MICROSERVICES.items():
        try:
            response = requests.get(url)
            statuses[service] = {"status": "UP", "message": response.text}
        except:
            statuses[service] = {"status": "DOWN", "message": "Service unavailable"}
    response = make_response(jsonify(statuses))
    response.headers["Access-Control-Allow-Origin"] = "*"
    response.headers["Access-Control-Allow-Methods"] = "GET, POST, OPTIONS"
    response.headers["Access-Control-Allow-Headers"] = "Content-Type"
    return response


if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000)
