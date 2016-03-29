# -*- encoding: utf-8 -*-
# stub: pragmatic_segmenter 0.3.7 ruby lib

Gem::Specification.new do |s|
  s.name = "pragmatic_segmenter"
  s.version = "0.3.7"

  s.required_rubygems_version = Gem::Requirement.new(">= 0") if s.respond_to? :required_rubygems_version=
  s.require_paths = ["lib"]
  s.authors = ["Kevin S. Dias"]
  s.date = "2016-01-12"
  s.description = "Pragmatic Segmenter is a sentence segmentation tool for Ruby. It allows you to split a text into an array of sentences. This gem provides 2 main benefits over other segmentation gems - 1) It works well even with ill-formatted text 2) It works for multiple languages "
  s.email = ["diasks2@gmail.com"]
  s.homepage = "https://github.com/diasks2/pragmatic_segmenter"
  s.licenses = ["MIT"]
  s.rubygems_version = "2.5.1"
  s.summary = "A rule-based sentence boundary detection gem that works out-of-the-box across many languages"

  s.installed_by_version = "2.5.1" if s.respond_to? :installed_by_version

  if s.respond_to? :specification_version then
    s.specification_version = 4

    if Gem::Version.new(Gem::VERSION) >= Gem::Version.new('1.2.0') then
      s.add_runtime_dependency(%q<unicode>, [">= 0"])
      s.add_development_dependency(%q<bundler>, ["~> 1.7"])
      s.add_development_dependency(%q<rake>, ["~> 10.0"])
      s.add_development_dependency(%q<rspec>, [">= 0"])
      s.add_development_dependency(%q<guard-rspec>, [">= 0"])
    else
      s.add_dependency(%q<unicode>, [">= 0"])
      s.add_dependency(%q<bundler>, ["~> 1.7"])
      s.add_dependency(%q<rake>, ["~> 10.0"])
      s.add_dependency(%q<rspec>, [">= 0"])
      s.add_dependency(%q<guard-rspec>, [">= 0"])
    end
  else
    s.add_dependency(%q<unicode>, [">= 0"])
    s.add_dependency(%q<bundler>, ["~> 1.7"])
    s.add_dependency(%q<rake>, ["~> 10.0"])
    s.add_dependency(%q<rspec>, [">= 0"])
    s.add_dependency(%q<guard-rspec>, [">= 0"])
  end
end
