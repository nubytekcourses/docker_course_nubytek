async function fetchStatus() {
    const servicesDiv = document.getElementById('services');
    servicesDiv.innerHTML = "Loading...";
    try {
        const response = await fetch('http://192.168.1.14:8080/status');
        const data = await response.json();
        servicesDiv.innerHTML = '';
        Object.keys(data).forEach(service => {
            const div = document.createElement('div');
            div.className = 'service';
            div.innerHTML = `<strong>${service}</strong>: ${data[service].status} - ${data[service].message}`;
            servicesDiv.appendChild(div);
        });
    } catch (err) {
        servicesDiv.innerHTML = 'Error fetching service status.';
    }
}
