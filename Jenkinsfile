 podTemplate(
    containers: [
        containerTemplate(args: 'cat', name: 'docker', command: '/bin/sh -c', image: 'docker', ttyEnabled: true),
        containerTemplate(args: 'cat', command: '/bin/sh -c', image: 'lachlanevenson/k8s-helm:v3.5.2', name: 'helm', ttyEnabled: true),
	containerTemplate(name: 'jnlp', image: 'lachlanevenson/jnlp-slave:3.10-1-alpine', args: '${computer.jnlpmac} ${computer.name}', workingDir: '/home/jenkins', resourceRequestCpu: '200m', resourceLimitCpu: '300m', resourceRequestMemory: '256Mi', resourceLimitMemory: '512Mi'),
	containerTemplate(name: 'helm', image: 'lachlanevenson/k8s-helm:v2.6.0', command: 'cat', ttyEnabled: true),
	containerTemplate(name: 'kubectl', image: 'lachlanevenson/k8s-kubectl:v1.4.8', command: 'cat', ttyEnabled: true)
    ],
    volumes: [
        hostPathVolume(mountPath: '/var/run/docker.sock', hostPath: '/var/run/docker.sock')
    ]
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
           sh "docker build -t ${image}:${gitCommit} ."
           sh "docker push ${image}:${gitCommit}"
	}
      }
    }
      stage ('deploy to k8s') {
	gitCommit = sh(returnStdout: true, script: 'git rev-parse HEAD').trim()
        container('helm') {
          // Deploy using Helm chart
          sh "helm install app laravel-app/"
	  sh "echo $?"
        }
     }
}
}

// 
// Rather than inline YAML, you could use: yaml: readTrusted('jenkins-pod.yaml')
// Or, to avoid YAML: containers: [containerTemplate(name: 'maven', image: 'maven:3.6.3-jdk-8', command: 'sleep', args: 'infinity')]



