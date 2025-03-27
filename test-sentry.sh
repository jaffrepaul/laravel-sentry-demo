#!/bin/bash

echo "Testing Sentry error routes..."

# Basic exception
echo "\nTesting /debug-sentry..."
curl -s -o /dev/null -w "Status: %{http_code}\n" http://localhost:8000/debug-sentry

echo "\nTesting /trigger-error..."
curl -s -o /dev/null -w "Status: %{http_code}\n" http://localhost:8000/trigger-error

# Database error
echo "\nTesting /debug-db..."
curl -s -o /dev/null -w "Status: %{http_code}\n" http://localhost:8000/debug-db

# Validation error
echo "\nTesting /debug-validation..."
curl -s -o /dev/null -w "Status: %{http_code}\n" http://localhost:8000/debug-validation

# Authentication error
echo "\nTesting /debug-auth..."
curl -s -o /dev/null -w "Status: %{http_code}\n" http://localhost:8000/debug-auth

# Not Found error
echo "\nTesting /debug-not-found..."
curl -s -o /dev/null -w "Status: %{http_code}\n" http://localhost:8000/debug-not-found

echo "\nAll routes tested! Check your Sentry dashboard for the errors."
