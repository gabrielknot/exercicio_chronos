// Build a Maven project using the standard image and Scripted syntax.
// Rather than inline YAML, you could use: yaml: readTrusted('jenkins-pod.yaml')
// Or, to avoid YAML: containers: [containerTemplate(name: 'maven', image: 'maven:3.6.3-jdk-8', command: 'sleep', args: 'infinity')]
podTemplate(yaml: '''
apiVersion: v1
kind: Pod
spec:
  containers:
  - name: maven
    image: maven:3.6.3-jdk-8
    command:
    - sleep
    args:
    - infinity
''') {
    node(POD_LABEL) {
podTemplate(label: 'builder',
            containers: [
                    containerTemplate(name: 'jnlp', image: 'larribas/jenkins-jnlp-slave-with-ssh:1.0.0', args: '${computer.jnlpmac} ${computer.name}'),
                    containerTemplate(name: 'docker', image: 'docker', command: 'cat', ttyEnabled: true),
                    containerTemplate(name: 'kubectl', image: 'ceroic/kubectl', command: 'cat', ttyEnabled: true),
                    containerTemplate(name: 'maven', image: 'maven:3.3.9-jdk-8-alpine', ttyEnabled: true, command: 'cat')
            ],
            volumes: [
                    hostPathVolume(hostPath: '/var/run/docker.sock', mountPath: '/var/run/docker.sock'),
                    secretVolume(secretName: 'maven-settings', mountPath: '/root/.m2'),
                    secretVolume(secretName: 'kubeconfig', mountPath: '/root/kubeconfig'),
                    persistentVolumeClaim(claimName: 'mavenrepo-volume-claim', mountPath: '/root/.m2nrepo')
            ]) {

        node('builder') {

            stage('Checkout') {
                checkout scm
            }
            stage('Build docker image') {
                gitCommit = sh(returnStdout: true, script: 'git rev-parse HEAD').trim()
                DOCKER_HUB_USER = gabrileknot
		DOCKER_IMAGE = php_nginx
                DOCKER_IMAGE_REPO = "${DOCKER_HUB_USER }/${DOCKER_IMAGE}"
                container('docker') {
                    withDockerRegistry([credentialsId: 'ecr:eu-west-1:AWS ECR', url: "https://${DOCKER_IMAGE_REPO}"]) {
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
