const express = require('express')
const serveStatic = require('serve-static')
const path = require('path')

const app = express()

app.use('/', serveStatic(path.join(__dirname, '/dist')))
app.use('/jobs', serveStatic(path.join(__dirname, '/dist')))
app.use('/jobs/applicant/login', serveStatic(path.join(__dirname, '/dist')))
app.use('/jobs/applicant/register', serveStatic(path.join(__dirname, '/dist')))

const port = process.env.PORT || 8080
app.listen(port)