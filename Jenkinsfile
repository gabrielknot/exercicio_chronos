#!groovy

pipeline {
  agent none
    stage('Docker Build') {
      agent any
      steps {
        sh 'docker build -t gabrielknot/php_fpm:latest .'
      }
    }
    stage('Docker Push') {
      agent any
      steps {
        withCredentials([usernamePassword(credentialsId: 'dockerHub', passwordVariable: 'dockerHubPassword', usernameVariable: 'dockerHubUser')]) {
	  sh "version = $(( 1 + $version ))"
          sh "docker login -u ${env.dockerHubUser} -p ${env.dockerHubPassword}"
          sh 'docker push gabrielknot/php_nginx:v$(version)
        }
      }
    }
  }
}
