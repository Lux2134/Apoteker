import subprocess
import argparse
import secrets
import json

db_data: dict = None
with open("db.json", "r") as o:
    db_data = json.loads(o.read())

parser = argparse.ArgumentParser()
parser.add_argument('-d', '--daemon', action='store_true')
args = parser.parse_args()

port = '7001'

random_char = secrets.token_hex(5)
name = 'hilal-uas'
container_name = f'{name}-{random_char}'

docker_args = [
    'docker',
    'run',
    '-p',
    f'127.0.0.1:{port}:80',
    '-h',
    'apoteker.mansuf.link',
    '--name',
    container_name
]

if args.daemon:
    docker_args.append('-d')

for key_env, value_env in db_data.items():
    docker_args.append("-e")
    docker_args.append(f"{key_env}={value_env}")

# Tell php scripts that we're working on docker process
docker_args.append("-e")
docker_args.append("DOCKER_PROCESS=true")


image = 'hilal-uas'

docker_args.append(image)

subprocess.run(docker_args)