# Repository Rules

## Project Information
- **Project Type**: Laravel Web Application
- **Database**: MySQL
- **Purpose**: Recycling Facility Directory Management System

## Testing Framework
- **targetFramework**: Playwright

## Key Features
- CRUD operations for recycling facilities
- Search and filter functionality
- CSV export capability
- Google Maps integration
- Material management system
- Responsive Bootstrap UI

## Database Schema
- facilities table (business_name, last_update_date, street_address, city)
- materials table (name)
- facility_material pivot table (many-to-many relationship)

## Routes
- GET / - Facility index page
- Resource routes for facilities (index, create, store, show, edit, update, destroy)

## Models
- Facility model with materials relationship
- Material model with facilities relationship