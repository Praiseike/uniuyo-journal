const ftpDeploy = require('ftp-deploy');
const fs = require('fs');
const dotenv = require('dotenv');

const config = {
  host: 'digi-essentials.com',
  port: 21, // standard FTP port
  username: 'praiseike@digi-essentials.com',
  password: 'pa33word**',
  localRoot: './', // Path to your Laravel application root
  remoteRoot: '/api.digi-essentials.com/laravel/', // Path on the server where to deploy (usually public_html)
  exclude: ['storage', 'bootstrap/cache', 'vendor'] // Exclude these directories from upload
};

function deploy() {
  ftpDeploy(config, (err) => {
    if (err) {
      console.error(err);
      return;
    }

    console.log('Deployment successful!');
  });
}


if (fs.existsSync('.env')) {
  // Load environment variables from .env file if it exists
  dotenv.config();
  config.host = process.env.FTP_HOST;
  config.username = process.env.FTP_USERNAME;
  config.password = process.env.FTP_PASSWORD;
} else {
  console.warn('.env file not found. Using config values directly.');
}

deploy();
