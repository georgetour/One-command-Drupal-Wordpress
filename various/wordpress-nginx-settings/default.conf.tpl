server {
    listen {{ getenv "NGINX_PORT" }};
    server_name {{ getenv "NGINX_HOST" }};
    root {{ getenv "NGINX_ROOT" }};
    client_max_body_size 64M;

  location / { 
    root {{ getenv "NGINX_ROOT" }};
    index index.php index.html index.htm; 

    if (-f $request_filename) { 
      expires 30d; 
      break; 
    } 

    if (!-e $request_filename) { 
      rewrite ^(.+)$ /index.php?q=$1 last; 
    } 
  } 
  
  location ~ .php$ { 
    fastcgi_pass 127.0.0.1:9000;  # port where FastCGI processes were spawned 
    fastcgi_index  index.php; 
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;    
    fastcgi_param PATH_INFO $fastcgi_path_info;
    include fastcgi_params;
  } 
} 