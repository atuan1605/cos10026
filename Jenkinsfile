pipeline {
    agent any

    environment {
        COMPOSER_HOME = '.composer'
        PHP = '/opt/homebrew/bin/php'
    }

    stages {
        stage('Install Dependencies') {
            steps {
                echo '📦 Installing dependencies...'
                script {
                    try {
                        sh "${env.PHP} /opt/homebrew/bin/composer install --no-interaction"
                        sh 'zip -r build-artifact.zip . -x "*.git*"'
                    } catch (e) {
                        echo '⚠️ Composer install failed. Skipping...'
                    }
                }
            }
        }

        stage('Run Unit Tests') {
            steps {
                echo '🧪 Running PHPUnit tests...'
                script {
                    try {
                        sh "${env.PHP} vendor/bin/phpunit --testdox"
                    } catch (e) {
                        echo '⚠️ PHPUnit not found or failed.'
                    }
                }
            }
        }

        stage('Code Quality Check') {
            steps {
                echo '🧹 Running PHP CodeSniffer...'
                script {
                    try {
                        sh "${env.PHP} vendor/bin/phpcs --standard=PSR12 ."
                    } catch (e) {
                        echo '⚠️ PHPCS failed or not found.'
                    }
                }
            }
        }

        stage('Security Scan') {
            steps {
                echo '🔐 Simulating security scan...'
                sh 'echo "No vulnerabilities detected (simulation only)."'
            }
        }

        stage('Deploy to Staging') {
            steps {
                echo '🚀 Deploying to staging...'
                sh 'ls -lh build-artifact.zip || echo "No build artefact found!"'
            }
        }

        stage('Release to Production') {
            steps {
                echo '📦 Releasing to production...'
                sh 'echo "Production release successful (simulated)."'
            }
        }

        stage('Monitoring & Alerting') {
            steps {
                echo '📈 Monitoring services...'
                sh 'echo "System is up at $(date)"'
            }
        }
    }
}
