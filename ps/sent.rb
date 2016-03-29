#!/usr/bin/ruby

number = ARGV[0]
path = ARGV[1]

require 'json'
require 'pragmatic_segmenter/segmenter'

text =  File.read(path + '/strip_html/'+ number +'.html')

ps = PragmaticSegmenter::Segmenter.new(text: text)
sentences =  ps.segment

fJson = File.open(path + "/json/"+ number +".html","w")
fJson.write(sentences)
fJson.close

