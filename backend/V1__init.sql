CREATE TABLE users
(
    id       SERIAL PRIMARY KEY,
    name     VARCHAR(255) NOT NULL UNIQUE,
    role     VARCHAR(255) NOT NULL DEFAULT 'user',
    password VARCHAR(255) NOT NULL,
    email    VARCHAR(255) NOT NULL UNIQUE
);
create Table Goods
(
    id          SERIAL PRIMARY KEY,
    name        VARCHAR(100) NOT NULL,
    cost        INT          NOT NULL,
    description VARCHAR(500) NOT NULL
)
-- Populating the 'users' table
-- Note: All passwords are 'password123' (hashed using BCRYPT)
INSERT INTO users (name, email, password, role)
VALUES
    ('Admin User', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
    ('John Doe', 'john.doe@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user'),
    ('Jane Smith', 'jane.smith@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user');

-- Populating the 'Goods' table
INSERT INTO Goods (name, cost, description)
VALUES
    ('Gaming Mouse RGB', 45, 'Ergonomic gaming mouse with customizable RGB lighting and 12000 DPI.'),
    ('Mechanical Keyboard', 89, 'Full-sized mechanical keyboard with blue switches and tactile feedback.'),
    ('27-inch Monitor', 240, 'IPS panel, 144Hz refresh rate, 2K resolution for professional gaming.'),
    ('XXL Mouse Pad', 15, 'Smooth cloth surface with stitched edges, size 900x400mm.'),
    ('Gaming Headset', 56, 'Over-ear headphones with 7.1 surround sound and noise-canceling microphone.');