from flask import Flask, request, jsonify
import requests

app = Flask(__name__)

# Definir servicios por tenant
TENANT_SERVICES = {
    'tenant_1': {
        'users': 'http://users:5000/status',
        'payments': 'http://payments:5000/status'
    },
    'tenant_2': {
        'users': 'http://users:5000/status',
        'payments': 'http://payments:5000/status'
    }
}

@app.route('/status')
def status():
    tenant = request.args.get('tenant')  # Obtener el tenant desde los parámetros de la URL
    if tenant not in TENANT_SERVICES:
        return jsonify({"error": "Tenant not found"}), 404

    services = TENANT_SERVICES[tenant]
    statuses = {}
    for service, url in services.items():
        try:
            response = requests.get(url)
            statuses[service] = {"status": "UP", "message": response.text}
        except requests.RequestException as e:
            statuses[service] = {"status": "DOWN", "message": str(e)}

    return jsonify(statuses)

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
