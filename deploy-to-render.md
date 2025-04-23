# Deploying DotaHunt to Render.com

Since we've prepared the application for deployment to Render.com, here are the simplified steps to deploy:

## Step 1: Create a PostgreSQL Database on Render

1. Go to [Render Dashboard](https://dashboard.render.com/)
2. Click on "New" and select "PostgreSQL"
3. Fill in the details:
   - Name: `dotahunt-db`
   - Database: `dotahunt`
   - User: `dotahunt`
   - Select the free plan
4. Click "Create Database"
5. Once created, note the "Internal Database URL" - you'll need this for the next step

## Step 2: Create a Web Service on Render

1. Click on "New" and select "Web Service"
2. Connect your GitHub repository or upload the code directly
3. Fill in the details:
   - Name: `dotahunt`
   - Runtime: `PHP`
   - Build Command: `composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev && npm install && npm run production`
   - Start Command: `php artisan migrate --force && php artisan config:cache && php artisan route:cache && php artisan view:cache && php -S 0.0.0.0:$PORT -t public`
   
4. Add the following environment variables:
   - `APP_ENV`: `production`
   - `APP_DEBUG`: `false`
   - `APP_KEY`: Leave blank (will be generated automatically)
   - `APP_URL`: Will be filled automatically with your Render URL
   - `DATABASE_URL`: Paste the Internal Database URL from Step 1
   - `DB_CONNECTION`: `pgsql`
   - `CACHE_DRIVER`: `file`
   - `SESSION_DRIVER`: `cookie`
   - `QUEUE_CONNECTION`: `database`
   - `LOG_CHANNEL`: `stderr`

5. Click "Create Web Service"

## Step 3: Monitor the Deployment

1. Render will automatically build and deploy your application
2. You can monitor the deployment logs in the Render dashboard
3. Once deployment is complete, click on the URL to access your application

## Step 4: Post-Deployment Tasks

1. If you need to seed the database, you can use the Render shell to run:
   ```
   php artisan db:seed
   ```

2. Configure any additional services like Steam API integration or Pusher for real-time features by adding the appropriate environment variables.

## Troubleshooting

If you encounter any issues during deployment:

1. Check the deployment logs in the Render dashboard
2. Make sure the PostgreSQL database is properly connected
3. Verify that all required environment variables are set correctly

For any spatial features that might cause issues with PostgreSQL, we've already made the necessary modifications to ensure compatibility.
