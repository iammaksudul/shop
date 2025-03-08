#!/bin/bash

# Define the project directory and file paths
PROJECT_DIR="/home/m1ksu4ul1l1m/public_html/licensing-system"  # Updated project path
ZIP_FILE="licensing-system-main.zip" # GitHub zip file name
EXTRACT_DIR="$PROJECT_DIR/licensing-system"

# Step 1: Download and unzip the project
echo "Downloading and unzipping the project..."
wget -q https://github.com/iammaksudul/licensing-system/archive/refs/heads/main.zip -O $PROJECT_DIR/$ZIP_FILE  # GitHub link for 
the project
if [ ! -f "$PROJECT_DIR/$ZIP_FILE" ]; then
  echo "Error: Failed to download the project. Check the URL or network connection."
  exit 1
fi
unzip -q $PROJECT_DIR/$ZIP_FILE -d $PROJECT_DIR
echo "Project unzipped successfully."

# Step 2: Navigate to the project directory
cd $EXTRACT_DIR || { echo "Error: Could not find project directory."; exit 1; }

# Step 3: Check if the .env file exists, and create a default if not
if [ ! -f "$EXTRACT_DIR/.env" ]; then
    echo "Creating default .env file..."
    cp .env.example .env || { echo "Error: .env.example file not found."; exit 1; }

    # Replace with default configurations or prompt the user
    sed -i 's/DB_USERNAME=root/DB_USERNAME=your_db_user/' .env
    sed -i 's/DB_PASSWORD=/DB_PASSWORD=your_db_password/' .env
    sed -i 's/PAYPAL_CLIENT_ID=your-paypal-client-id/PAYPAL_CLIENT_ID=your_paypal_client_id/' .env
    sed -i 's/PAYPAL_SECRET=your-paypal-secret/PAYPAL_SECRET=your_paypal_secret/' .env
    sed -i 's/SMTP_HOST=smtp.yourmailserver.com/SMTP_HOST=smtp.your_smtp_server.com/' .env
    sed -i 's/SMTP_USERNAME=your-email@example.com/SMTP_USERNAME=your_smtp_username/' .env
    sed -i 's/SMTP_PASSWORD=your-email-password/SMTP_PASSWORD=your_smtp_password/' .env

    echo ".env file created and configured."
else
    echo ".env file already exists."
fi

# Step 4: Install Composer dependencies
echo "Installing Composer dependencies..."
if [ ! -f "composer.json" ]; then
    echo "Error: composer.json file not found. Please create it first."
    exit 1
fi
composer install --no-interaction
echo "Composer dependencies installed successfully."

# Step 5: Import the database schema
echo "Importing the database schema..."
if [ ! -f "$EXTRACT_DIR/sql/schema.sql" ]; then
    echo "Error: schema.sql file not found. Please ensure the SQL schema file is present."
    exit 1
fi
mysql -u root -p < $EXTRACT_DIR/sql/schema.sql
echo "Database schema imported successfully."

# Step 6: Fix file permissions for directories (logs, vendor, uploads)
echo "Setting up permissions for directories..."
mkdir -p $EXTRACT_DIR/logs $EXTRACT_DIR/vendor $EXTRACT_DIR/uploads
chmod -R 755 $EXTRACT_DIR/logs
chmod -R 755 $EXTRACT_DIR/vendor
chmod -R 755 $EXTRACT_DIR/uploads
echo "Permissions set for logs, vendor, and uploads directories."

# Step 7: Check for necessary permissions on .env and .htaccess
echo "Setting correct permissions for .env and .htaccess files..."
chmod 644 $EXTRACT_DIR/.env
chmod 644 $EXTRACT_DIR/.htaccess
echo ".env and .htaccess file permissions set."

# Step 8: Verify PayPal/SMTP and API keys (optional check)
echo "Verifying PayPal and SMTP configurations..."
if grep -q "your_paypal_client_id" "$EXTRACT_DIR/.env" && grep -q "your_smtp_username" "$EXTRACT_DIR/.env"; then
    echo "Payment gateway and SMTP configurations verified."
else
    echo "Warning: PayPal or SMTP settings are not configured correctly in .env."
fi

# Step 9: Start the web server (assuming Apache for simplicity)
echo "Starting Apache server..."
# Remove `sudo` if it's not available
systemctl restart apache2
echo "Apache server restarted."

# Step 10: Provide a success message
echo "Setup completed successfully! Your Licensing System should now be up and running."

