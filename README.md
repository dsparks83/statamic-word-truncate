# Statamic word based truncate modifier
Move Statamic's word based truncation to a modifier, it will also close any open tags in the generated excerpt.
Copy the folder word_truncate folder to your _add_ons folder.
Apply like any other filter with a colon to indicate the number of words you'd like in the excerpt.

{{ content|word_truncate:75 }}

That will produce an excerpt 75 words in length.

You can change your ending with a second parameter

{{ content|word_truncate:75:more }}

However be careful as it's likely to trigger issues if you put much more than a text string in. If you need something more then edit this bit of code at the top of the plugin

if(isset($parameters[1]) && $parameters[1] != "") $ending = $parameters[1];
else $ending = "&amp;hellip;";

Replace *&amp;hellip;* with your preferred ending.
      
      