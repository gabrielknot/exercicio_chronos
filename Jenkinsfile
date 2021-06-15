podTemplate(yaml: """
apiVersion: v1
kind: Pod
spec:
  containers:
  - name: docker
    image: docker:1.11
    command: ['cat']
    tty: true
    volumeMounts:
    - name: dockersock
      mountPath: /var/run/docker.sock
  volumes:
  - name: dockersock
    hostPath:
      path: /var/run/docker.sock
"""
  ) {

  def image = "gabrielknot/php_nginx"
  node(POD_LABEL) {
    stage('Checkout') {
	checkout scm
    }

    stage('Build Docker image') {
      container('docker') {
        sh "docker build -t ${image} ."
      }
                  }
    stage('Build docker image') {
	gitCommit = sh(returnStdout: true, script: 'git rev-parse HEAD').trim()
	DOCKER_HUB_USER = gabrileknot
	DOCKER_IMAGE = php_nginx
	DOCKER_IMAGE_REPO = "${DOCKER_HUB_USER }/${DOCKER_IMAGE}"
	container('docker') {
	    withDockerRegistry([credentialsId: 'dockerHub', url: ""]) {
		sh "docker build . -t ${serviceName}:${gitCommit}"
		sh "docker tag ${serviceName}:${gitCommit} ${DOCKER_IMAGE_REPO}:${gitCommit}"
		sh "docker tag ${serviceName}:${gitCommit} ${DOCKER_IMAGE_REPO}:latest"
		sh "docker push ${DOCKER_IMAGE_REPO}:${gitCommit}"
		sh "docker push ${DOCKER_IMAGE_REPO}:latest"
		slackSend color: '#4CAF50', message: "New version of ${serviceName}:${gitCommit} pushed to ECR!"
	    }

	}
    }

    }
  }
}

// 
// Rather than inline YAML, you could use: yaml: readTrusted('jenkins-pod.yaml')
// Or, to avoid YAML: containers: [containerTemplate(name: 'maven', image: 'maven:3.6.3-jdk-8', command: 'sleep', args: 'infinity')]
