#!/bin/bash

# Check if the user provided a parameter (up or down)
if [ "$1" == "up" ]; then

    echo "Starting Docker containers ⚠️"
        make elk-up && sleep 1
        make db-up && sleep 1
        make up && sleep 1
        make ar c=optimize
        make ar c=key:generate
        make ar c=optimize
    echo "Docker containers are up! 🔥🔥🔥"

elif [ "$1" == "down" ]; then

    echo "Stopping Docker containers ⛔️"
       make elk-down
       make db-down
       make down
    echo "Docker containers are down! ✅"

else
    echo "Usage: $0 [up|down] ❌❌❌"
    exit 1
fi
