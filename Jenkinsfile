 podTemplate(
    containers: [
        containerTemplate(args: 'cat', name: 'docker', command: '/bin/sh -c', image: 'docker', ttyEnabled: true),
        containerTemplate(args: 'cat', command: '/bin/sh -c', image: 'lachlanevenson/k8s-helm:v3.5.2', name: 'helm', ttyEnabled: true),
	containerTemplate(name: 'jnlp', image: 'lachlanevenson/jnlp-slave:3.10-1-alpine', args: '${computer.jnlpmac} ${computer.name}', workingDir: '/home/jenkins', resourceRequestCpu: '200m', resourceLimitCpu: '300m', resourceRequestMemory: '256Mi', resourceLimitMemory: '512Mi'),
	containerTemplate(args: 'cat', command: '/bin/sh -c', image: 'lachlanevenson/k8s-helm:v3.5.2', name: 'helm-container', ttyEnabled: true),
	containerTemplate(name: 'kubectl', image: 'lachlanevenson/k8s-kubectl:v1.4.8', command: 'cat', ttyEnabled: true)
    ],
    volumes: [
        hostPathVolume(mountPath: '/var/run/docker.sock', hostPath: '/var/run/docker.sock')
    ]
) {
  def image = "gabrielknot/php_nginx"
  node(POD_LABEL) {
    stage('Checkout') {
	checkout scm
    }
	gitCommit = sh(returnStdout: true, script: 'git rev-parse HEAD').trim()
	// short SHA, possibly better for chat notifications, etc.
	shortCommit = gitCommit.take(6)
      stage('Build Docker image') {
        container('docker') {
          withDockerRegistry([credentialsId: 'dockerHub', url: ""]) {
	     sh "echo $shortCommit"
             sh "docker build -t ${image}:${shortCommit} ."
             sh "docker push ${image}:${shortCommit}"
          }
        }
      }
      stage ('deploy to k8s') {
        container('helm') {
	  sh '''
	    echo $gitCommit
	    DEPLOYED=$(helm list |grep -E "^${PACKAGE}" |grep DEPLOYED |wc -l)
            if [ $DEPLOYED == 0 ] ; then
              helm install app --set image.tag="${shortCommit}" laravel-app/
            else
              helm upgrade app --set image.tag="${shortCommit}" laravel-app/
            fi
            echo "deployed!"
            '''
        }
     }
}
}

// 
// Rather than inline YAML, you could use: yaml: readTrusted('jenkins-pod.yaml')
// Or, to avoid YAML: containers: [containerTemplate(name: 'maven', image: 'maven:3.6.3-jdk-8', command: 'sleep', args: 'infinity')]



