# Broadcaster
A plugin to broadcast messages to all players

# Config
```yaml
# The below config message will show up before the messages declared below (NOTE: You can use & for color coding but none of the other variables described above)
prefix: "&8[&l&6Broadcaster&r&8] &f"

# The below config is the number of seconds in between each message
message_interval: 60

# If enabled then a message will appear in the console
# If disabled then messages are only sent to players who are online
display_on_the_console: true

# You can see the sound list at https://www.digminecraft.com/lists/sound_list_pe.php
# Leave blank if you don't want to add broadcast sound
broadcast_sound: ""

# The below config are the messages that will be sent in-game
# Placeholders:
#   - & for color coding
#   - {line} for a new line
#   - {max_players} for the max players of the server
#   - {online_players} for the online player count
messages:
  - "Welcome to Your Network"
  - "Don't forget to vote this server in https://yourserver.com/vote"
  - "Buy ranks and other things at https://yourserver.com/store"
```

# Issue
Found an error? Create an issue [here](https://github.com/AraaCuteUwU/Broadcaster/issues)