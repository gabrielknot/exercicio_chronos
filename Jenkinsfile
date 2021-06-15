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
    node(POD_LABEL) {
podTemplate(label: 'builder',
            containers: [
                    containerTemplate(name: 'jnlp', image: 'larribas/jenkins-jnlp-slave-with-ssh:1.0.0', args: '${computer.jnlpmac} ${computer.name}'),
                    containerTemplate(name: 'docker', image: 'docker', command: 'cat', ttyEnabled: true),
                    containerTemplate(name: 'kubectl', image: 'ceroic/kubectl', command: 'cat', ttyEnabled: true),
            ],
            volumes: [
                    hostPathVolume(hostPath: '/var/run/docker.sock', mountPath: '/var/run/docker.sock'),
                    secretVolume(secretName: 'maven-settings', mountPath: '/root/.m2'),
                    secretVolume(secretName: 'kubeconfig', mountPath: '/root/kubeconfig'),
            ]) {

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
           sh "docker build -t ${image}:${gitCommit} ."
           sh "docker push ${image}:${gitCommit}"
	}
      }
    }
  }
}
}

// 
// Rather than inline YAML, you could use: yaml: readTrusted('jenkins-pod.yaml')
// Or, to avoid YAML: containers: [containerTemplate(name: 'maven', image: 'maven:3.6.3-jdk-8', command: 'sleep', args: 'infinity')]


