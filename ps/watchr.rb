#!/usr/bin/ruby
require 'pragmatic_segmenter/segmenter'
require 'pathname'

currentPath = File.expand_path(File.dirname(__FILE__))


while(1)
	
	Dir[currentPath + "/../basic/web/uploads/strip_html/*"].each do |filename|
		text =  File.read(filename)
		File.delete(filename)
        newfilename = Pathname.new(filename).basename.to_s 
		ps = PragmaticSegmenter::Segmenter.new(text: text)
        sentences =  ps.segment
        fJson = File.open(currentPath + "/../basic/web/uploads/json/" + newfilename,"w")
        fJson.write(sentences)
        fJson.close

		end
	sleep(2)
end