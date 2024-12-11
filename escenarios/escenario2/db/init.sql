-- Crear tabla para usuarios
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    tenant_id VARCHAR(50) NOT NULL
);

-- Insertar datos iniciales en usuarios
INSERT INTO users (name, email, tenant_id) VALUES
('John Doe', 'john@tenant1.com', 'tenant_1'),
('Jane Smith', 'jane@tenant2.com', 'tenant_2');

-- Crear tabla para pagos
CREATE TABLE payments (
    id SERIAL PRIMARY KEY,
    user_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    status VARCHAR(50) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Insertar datos iniciales en pagos
INSERT INTO payments (user_id, amount, status) VALUES
(1, 100.00, 'completed'),
(2, 50.00, 'pending');

