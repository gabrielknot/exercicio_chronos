#!groovy

pipeline {
  agent none
    stage('Docker Build') {
      agent any
      steps {
	  sh "version = $(( 1 + $version ))"
        sh 'docker build -t gabrielknot/php_fpm:v$(version) .'
      }
    }
    stage('Docker Push') {
      agent any
      steps {
        withCredentials([usernamePassword(credentialsId: 'dockerHub', passwordVariable: 'dockerHubPassword', usernameVariable: 'dockerHubUser')]) {
          sh "docker login -u ${env.dockerHubUser} -p ${env.dockerHubPassword}"
          sh 'docker push gabrielknot/php_nginx:v$(version)
        }
      }
    }
  }
}
