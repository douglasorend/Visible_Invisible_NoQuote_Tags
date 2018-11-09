[hr]
[center][color=red][size=16pt][b]VISIBLE, INVISIBLE AND NOQUOTE TAGS v3.5[/b][/size][/color]
[url=http://www.simplemachines.org/community/index.php?action=profile;u=253913][b]By Dougiefresh[/b][/url] -> [url=http://custom.simplemachines.org/mods/index.php?mod=4056]Link to Mod[/url]
[/center]
[hr]

[color=blue][b][size=12pt][u]Introduction[/u][/size][/b][/color]
This modification adds bbcodes that will make content visible or invisible based on criteria in the parameters of the bbcode, and a bbcode to prevent someone from easily quoting text within a post.

The new [b]visible[/b] and [b]invisible[/b] BBCodes take any of the following parameters:
[code]
[b]u={user ID}[,{user_ID}....][/b] => User ID(s) seperated by commas
[b]g={group ID}[,{group_ID}....][/b] => Membegroup ID(s) seperated by commas
[b]min_posts={number of posts}[/b] => Filter by minimum number of posts; valid: positive integer value
[b]max_posts={number of posts}[/b] => Filter by maximum number of posts; valid: positive integer value
[b]guests={answer}[/b] => Filters by guest status; valid: [b]1[/b], [b]0[/b], [b]true[/b], [b]false[/b], [b]y[/b], [b]yes[/b], [b]n[/b], or [b]no[/b].
[b]members={answer}[/b] => Filters by member status; valid: [b]1[/b], [b]0[/b], [b]true[/b], [b]false[/b], [b]y[/b], [b]yes[/b], [b]n[/b], or [b]no[/b].
[b]banned={answer}[/b] => Filters by ban status; valid: [b]1[/b], [b]0[/b], [b]true[/b], [b]false[/b], [b]y[/b], [b]yes[/b], [b]n[/b], or [b]no[/b].
[b]karma={minimum karma required}[/b] = Filters by amount of karma received; valid: integer value.
[b]replied={topic ID}[/b] = Filter by whether member has replied to given topic or current topic if value is 0; valid: topic ID or 0.
[b]warning={warning level}[/b] = Filter by whether member has maximum warning level; valid: integer value.
[/code]

These parameters are also accepted, but the data supplied must be [b]QUOTED[/b] and is treated as a partial regex search value.  For example, [b]username="Doug"[/b] would match [b]dougiefresh[/b], [b]freshdoug[/b], [b]weird_doug[/b] and [b]doug[/b]...
[code]
[b]username={username}[,{username}...][/b] => Username(s) seperated by commas
[b]user={display name}[,{display name}...][/b] => Display name(s) seperated by commas
[b]group={membergroup}[,{membergroup}...][/b] => Membergroup name(s) seperated by commas
[b]lang={language}[,{language}...][/b] => Language(s) seperated by commas
[/code]

For example, if you wanted to make the portion invisible to user # 1 and membergroup ID # 2, you would use this:
[code][invisible u=1 g=2]Whatever goes here[/invisible][/code]
If you wanted to make it invisible to just guests, you would use this:
[code][invisible guests=y]Whatever goes here[/invisible][/code]
Likewise, making things visible to only certain groups or people is equally easy.  Just replace [b]invisible[/b] with [b]visible[/b]!

In order to keep people from easily quoting part (or all) of your post, just surround the unquotable part like this:
[code][noquote]Whatever goes here[/noquote][/code]

[b]VERSION 2.1[/b] adds the [b][else][/b] bbcode for the [b][nobbc][visible][/nobbc][/b] and [b][nobbc][invisible][/nobbc][/b] tags.  When present and the conditions are false, the part after [b][else][/b] will be displayed instead of nothing.

[color=blue][b][size=12pt][u]To-Do List[/u][/size][/b][/color]
o [DONE] Add support for custom fields.... (?)
o Add support for search values as whole strings instead of partial strings.... :p

[color=blue][b][size=12pt][u]Admin Settings[/u][/size][/b][/color]
There is a whole new admin area with three parts: [b]Admin[/b] => [b]Configuration[/b] => [b]VIVNQ Settings[/b]!  The first part is the [b]Shortcuts[/b] UI, where you can modify existing shortcuts.

The second area is the [b]Create New Tags[/b], where you can create new shortcuts for use within the forum.

The third area is the permission page, where you can set all the permissions of the mod easily in one spot (as opposed to going to the permissions area and setting it up per membergroup!)

There are 7 new permissions that one can assign the membergroups:
o Allow use of the "visible" tag"
o Quote the contents of "visible" tag
o Allow use of the "invisible" tag"
o Quote the contents of "invisible" tag
o Allow use of the "noquote" tag"
o Quote the contents of "noquote" tag
o Toggle filtering of "visible" & "invisible" tag

[color=blue][b][size=12pt][u]Other Notes[/u][/size][/b][/color]
If you upgrade from [b]v1.x[/b] of this mod to [b]v2.0[/b], this mod will not remove any "visible" or "invisible" tags that already exists within the messages table.  When a user doesn't have permission to use those tags, the tag is removed from the message before committing the message to the database.

[color=blue][b][size=12pt][u]Related Discussions[/u][/size][/b][/color]
o [url=https://www.simplemachines.org/community/index.php?topic=555572.msg3937962#msg3937962]Code to keep someone from quoting something in [noquote] tags....[/url]

[color=blue][b][size=12pt][u]Compatibility Notes[/u][/size][/b][/color]
This mod was tested on SMF 2.0.10, but should work on SMF 2.1 Beta 3, as well as SMF 2.0 and up.  SMF 1.x is not and will not be supported.

[color=blue][b][size=12pt][u]Changelog[/u][/size][/b][/color]
The changelog has been removed and can be seen at [url=http://www.xptsp.com/board/index.php?topic=515.msg783#msg783]XPtsp.com[/url].

[color=blue][b][size=12pt][u]License[/u][/size][/b][/color]
[quote]Copyright (c) 2015 - 2017, Douglas Orend
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

1. Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.

2. Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.[/quote]