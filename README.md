# ExpressionEngine-Add-Ons

## Contributor(s)

* [Spicer Matthews, Cloudmanic Labs, LLC](http://www.cloudmanic.com)


## About

This is a collection of [ExpressionEngine](http://expressionengine.com) add-ons. Each top level 
directory is a different add-on. These are add-ons we have developed at Cloudmanic Labs that 
are not part of our core products, so we are sharing them. You can use this code base as you 
wish. If you do something cool please share it back with us. 


## Install

Take the add ons you want to use and copy the entire folder to the expressionengine/third_party directory.

Then manage the add-on from the control panel.

## Add-On: click_tracker

This is a very basic module for tracking the source of a url request. For example, lets say you want to 
track all the people that come to your home page from your twitter profile page. You would install this module
and use the url it gives you on the module page as your url you share on your twitter profile page. So if the module
told you this was your url http://example.org/index.php?ACT=18&s=sourcename you would change the "sourcename" to 
however you want to reference it. So we would reference it as http://example.org/index.php?ACT=18&s=twitter.
Now anyone that goes to that url will get logged and then redirected to your cms home page. 

Be careful with this, it can fill out a database pretty quickly. 
