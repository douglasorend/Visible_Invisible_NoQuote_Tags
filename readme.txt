-------

# VISIBLE, INVISIBLE AND NOQUOTE TAGS v3.6

[**By Dougiefresh**](http://www.simplemachines.org/community/index.php?action=profile;u=253913) -> [Link to Mod](http://custom.simplemachines.org/mods/index.php?mod=4056)

-------

## Introduction
This modification adds bbcodes that will make content visible or invisible based on criteria in the parameters of the bbcode, and a bbcode to prevent someone from easily quoting text within a post.

The new **visible** and **invisible** BBCodes take any of the following parameters:
    
    **u={user ID}[,{user_ID}....]** => User ID(s) seperated by commas
    **g={group ID}[,{group_ID}....]** => Membegroup ID(s) seperated by commas
    **min_posts={number of posts}** => Filter by minimum number of posts; valid: positive integer value
    **max_posts={number of posts}** => Filter by maximum number of posts; valid: positive integer value
    **guests={answer}** => Filters by guest status; valid: **1**, **0**, **true**, **false**, **y**, **yes**, **n**, or **no**.
    **members={answer}** => Filters by member status; valid: **1**, **0**, **true**, **false**, **y**, **yes**, **n**, or **no**.
    **banned={answer}** => Filters by ban status; valid: **1**, **0**, **true**, **false**, **y**, **yes**, **n**, or **no**.
    **karma={minimum karma required}** = Filters by amount of karma received; valid: integer value.
    **replied={topic ID}** = Filter by whether member has replied to given topic or current topic if value is 0; valid: topic ID or 0.
    **warning={warning level}** = Filter by whether member has maximum warning level; valid: integer value.
    

These parameters are also accepted, but the data supplied must be **QUOTED** and is treated as a partial regex search value.  For example, **username="Doug"** would match **dougiefresh**, **freshdoug**, **weird_doug** and **doug**...
    
    **username={username}[,{username}...]** => Username(s) seperated by commas
    **user={display name}[,{display name}...]** => Display name(s) seperated by commas
    **group={membergroup}[,{membergroup}...]** => Membergroup name(s) seperated by commas
    **lang={language}[,{language}...]** => Language(s) seperated by commas
    

For example, if you wanted to make the portion invisible to user # 1 and membergroup ID # 2, you would use this:
`[invisible u=1 g=2]Whatever goes here[/invisible]`
If you wanted to make it invisible to just guests, you would use this:
`[invisible guests=y]Whatever goes here[/invisible]`
Likewise, making things visible to only certain groups or people is equally easy.  Just replace **invisible** with **visible**!

In order to keep people from easily quoting part (or all) of your post, just surround the unquotable part like this:
`[noquote]Whatever goes here[/noquote]`

**VERSION 2.1** adds the **[else]** bbcode for the **[nobbc][visible][/nobbc]** and **[nobbc][invisible][/nobbc]** tags.  When present and the conditions are false, the part after **[else]** will be displayed instead of nothing.

## To-Do List

- [DONE] Add support for custom fields.... (?)
- Add support for search values as whole strings instead of partial strings.... :p

## Admin Settings
There is a whole new admin area with three parts: **Admin** => **Configuration** => **VIVNQ Settings**!  The first part is the **Shortcuts** UI, where you can modify existing shortcuts.

The second area is the **Create New Tags**, where you can create new shortcuts for use within the forum.

The third area is the permission page, where you can set all the permissions of the mod easily in one spot (as opposed to going to the permissions area and setting it up per membergroup!)

There are 7 new permissions that one can assign the membergroups:

- Allow use of the "visible" tag"
- Quote the contents of "visible" tag
- Allow use of the "invisible" tag"
- Quote the contents of "invisible" tag
- Allow use of the "noquote" tag"
- Quote the contents of "noquote" tag
- Toggle filtering of "visible" & "invisible" tag

## Other Notes
If you upgrade from **v1.x** of this mod to **v2.0**, this mod will not remove any "visible" or "invisible" tags that already exists within the messages table.  When a user doesn't have permission to use those tags, the tag is removed from the message before committing the message to the database.

## Related Discussions

- [Code to keep someone from quoting something in [noquote] tags....](https://www.simplemachines.org/community/index.php?topic=555572.msg3937962#msg3937962)

## Compatibility Notes
This mod was tested on SMF 2.0.10, but should work on SMF 2.1 Beta 3, as well as SMF 2.0 and up.  SMF 1.x is not and will not be supported.

## Changelog
The changelog can be viewed at [XPtsp.com](http://www.xptsp.com/board/free-modifications/visible-invisible-noquote-tags/?tab=1).

## License
Copyright (c) 2015 - 2018, Douglas Orend

All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

1. Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.

2. Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.