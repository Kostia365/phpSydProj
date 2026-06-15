CREATE TABLE services
(
    id               SERIAL PRIMARY KEY,
    name             VARCHAR(100)   NOT NULL,
    price            DECIMAL(10, 2) NOT NULL,
    duration_minutes INTEGER        NOT NULL DEFAULT 30
);

CREATE TABLE users
(
    id       SERIAL PRIMARY KEY,
    name     VARCHAR(100) NOT NULL,
    email    VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role     VARCHAR(20)  NOT NULL DEFAULT 'customer'
);

CREATE TABLE bookings
(
    id               SERIAL PRIMARY KEY,
    user_id          INTEGER REFERENCES users (id) ON DELETE CASCADE,
    service_id       INTEGER REFERENCES services (id) ON DELETE RESTRICT,
    appointment_time TIMESTAMP   NOT NULL,
    status           VARCHAR(20) NOT NULL DEFAULT 'pending'
);

INSERT INTO services (name, price, duration_minutes)
VALUES ('man standart', 25.00, 45),
       ('bear cut', 15.00, 30),
       ('complex', 35.00, 75);

INSERT INTO users (email, name, password, role)
VALUES ('admin@barber.com', 'Admin', '123qwe', 'admin');