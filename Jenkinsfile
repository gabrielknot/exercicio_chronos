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
  def DOCKER_HUB_USER = "gabrileknot"
  def DOCKER_IMAGE = "php_nginx"
  def DOCKER_IMAGE_REPO = "${DOCKER_HUB_USER }/${DOCKER_IMAGE}"
  node(POD_LABEL) {
    stage('Checkout') {
	checkout scm
    }

    stage('Build Docker image') {
      gitCommit = sh(returnStdout: true, script: 'git rev-parse HEAD').trim()
      container('docker') {
        withDockerRegistry([credentialsId: 'dockerHub', url: ""]) {
           sh "docker build -t ${image} ."
	}
      }
    }
  }
}

// 
// Rather than inline YAML, you could use: yaml: readTrusted('jenkins-pod.yaml')
// Or, to avoid YAML: containers: [containerTemplate(name: 'maven', image: 'maven:3.6.3-jdk-8', command: 'sleep', args: 'infinity')]

