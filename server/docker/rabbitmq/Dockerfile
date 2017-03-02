FROM ubuntu:16.04
MAINTAINER stepan.okhorzin@gmail.com

ENV RABBITMQ_LOG_BASE /var/lib/rabbitmq
ENV RABBITMQ_MNESIA_BASE /var/lib/rabbitmq

#Install
RUN mkdir -p /var/lib/rabbitmq &&\
apt-get update && apt-get install -y rabbitmq-server && \
chown -R rabbitmq:rabbitmq /var/lib/rabbitmq ;

RUN sed -i  's/#NODENAME=rabbit/NODENAME=rabbitmq@rabbitmq/g' /usr/share/rabbitmq/rabbitmq-env.conf && \
cp /usr/share/rabbitmq/rabbitmq-env.conf /etc/rabbitmq/ &&\
echo "127.0.0.1   rabbitmq" > /etc/hosts && \
/usr/sbin/rabbitmq-server & \
sleep 10 && \
rabbitmqctl add_user gis gis && \
rabbitmqctl set_user_tags gis administrator && \
rabbitmqctl set_permissions -p / gis ".*" ".*" ".*" && \
rabbitmqctl stop ;

ENTRYPOINT /usr/sbin/rabbitmq-server

EXPOSE 5672
EXPOSE 15672