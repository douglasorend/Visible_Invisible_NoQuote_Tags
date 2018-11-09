[hr]
[center][color=red][size=16pt][b]VISIBLE, INVISIBLE AND NOQUOTE TAGS v1.0[/b][/size][/color]
[url=http://www.simplemachines.org/community/index.php?action=profile;u=253913][b]By Dougiefresh[/b][/url] -> [url=http://custom.simplemachines.org/mods/index.php?mod=4056]Link to Mod[/url]
[/center]
[hr]

[color=blue][b][size=12pt][u]Introduction[/u][/size][/b][/color]
This modification adds the bbcodes that will make content visible or invisible based on criteria in the parameters of the bbcode, and a bbcode to prevent someone from quoting text within a post.

The new [b]visible[/b] and [b]invisible[/b] BBCodes take any of the following parameters:
[quote]
[b]u={user ID}[,{user_ID}....][/b] => User ID or IDs seperated by commas
[b]g={group ID}[,{group_ID}....][/b] => Membegroup ID or IDs seperated by commas
[b]username={username}[,{username}...][/b] => Username(s) seperated by commas
[b]name={display name}[,{display name}...][/b] => Display name(s) seperated by commas
[b]group={membergroup}[,{membergroup}...][/b] => Membergroup name(s) seperated by commas
[b]guests={anything}[/b] => Filters by guest status, {anything} doesn't matter, but must be present.
[b]member={anything}[/b] => Filters by member status, {anything} doesn't matter, but must be present.
[b]lang={language}[,{language}...][/b] => Language(s) seperated by commas
[b]posts={number of posts}[/b] => Filter by minimum number of posts
[/quote]

For example, if you wanted to make the portion invisible to user # 1 and membergroup ID # 2, you would use this:
[quote][nobbc][invisible u=1 g=2]Whatever goes here[/invisible][/nobbc][/quote]
If you wanted to make it invisible just guests, you would use this:
[quote][nobbc][invisible guests=n]Whatever goes here[/invisible][/nobbc][/quote]
Likewise, making things visible to only certain groups or people is equally easy.  Just replace [b]invisible[/b] with [b]visible[/b]!

In order to keep people from quoting part (or all) of your post, just surround the unquotable part like this:
[quote][nobbc][noquote]Whatever goes here[/noquote][/nobbc][/quote]

[color=blue][b][size=12pt][u]Admin Settings[/u][/size][/b][/color]
There are no admin settings to this mod.  To disable, you must uninstall this mod.

[color=blue][b][size=12pt][u]Compatibility Notes[/u][/size][/b][/color]
This mod was tested on SMF 2.0.10, but should work on SMF 2.1 Beta 1, as well as SMF 2.0 and up.  SMF 1.x is not and will not be supported.

[color=blue][b][size=12pt][u]Changelog[/u][/size][/b][/color]
The changelog has been removed and can be seen at [url=http://www.xptsp.com/board/index.php?topic=515.msg783#msg783]XPtsp.com[/url].

[color=blue][b][size=12pt][u]License[/u][/size][/b][/color]
Copyright (c) 2015, Douglas Orend
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

1. Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.

2. Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.