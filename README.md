# SIP Calculator

A web application built with Laravel for calculating Systematic Investment Plan (SIP) returns and managing investment calculations.

## Features

- SIP calculation with compound interest
- User registration and authentication
- Calculation history management
- Responsive design
- Dark mode support
- Local storage for guest users
- Database storage for authenticated users

## Requirements

- PHP >= 8.1
- MySQL
- Composer
- XAMPP/Apache server

## Installation

1. Clone the repository:
```bash
git clone https://github.com/your-username/sip_calculator.git
cd sip_calculator
```

2. Install dependencies:
```bash
composer install
```

3. Create and configure environment file:
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure database in `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sip_calculator
DB_USERNAME=root
DB_PASSWORD=
```

5. Run migrations:
```bash
php artisan migrate
```

6. Start the development server:
```bash
php artisan serve
```

## Usage

1. Access the application at `http://localhost:8000`
2. Register a new account or use as guest
3. Enter your SIP details:
   - Monthly investment amount
   - Expected annual return rate
   - Investment duration
4. View calculation results and history

## Contributing

1. Fork the repository
2. Create your feature branch: `git checkout -b feature/my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin feature/my-new-feature`
5. Submit a pull request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
