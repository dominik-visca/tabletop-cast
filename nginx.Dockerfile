# Use the official Nginx image
FROM nginx:alpine

# Remove the default server definition
RUN rm /etc/nginx/conf.d/default.conf

# Copy your nginx configuration
COPY ./nginx/default.conf /etc/nginx/conf.d

# Set working directory to nginx asset directory
WORKDIR /var/www/public

# Expose port 80
EXPOSE 80
