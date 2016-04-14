Symfony Skeleton bootstrap responsive templated Application + HWIOAuthBundle

This is a special skeleton application for php <=5.3.3

=========================================================

Installation:

`composer install`

Configuration for extension "auth":

    auth:
        # an array of user id, got from OAuth provider
        # such users has ROLE_ADMIN role
        admins: []
        # flag if auth extension should persist user and tokens to DB
        # By default user is stored to session
        # If enabled, user also store to DB. This allow manage connected users
        persist:
            user:                 false
            user_access_token:    false

Enjoy!
