#!/usr/bin/perl 
print "content-type:text/html\n\n"; 
foreach $varname (sort keys %ENV) { 
print "$varname $ENV{$varname}<br>\n"; 
}