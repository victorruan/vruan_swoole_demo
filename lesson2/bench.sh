#!/usr/bin/env bash
# 我们可以模拟100个并发用户，对一个页面发送1000个请求
#
#./ab -n1000 -c100 http://vm1.jianfeng.com/a.html
ab -n5 -c5 http://0.0.0.0:8000/