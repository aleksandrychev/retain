/*
*@To-do: make readme in normal view with install commands
*/
install Ruby
install ruby sentences lib
start watcher.rb through supervizord
install uoconv
give www-data user sudoers to scripts
install auth module https://github.com/robregonm/yii2-auth

php yii migrate/up --migrationPath=@app/modules/auth/migrations

---INSTALL RUBY-------
cd
git clone https://github.com/rbenv/rbenv.git ~/.rbenv
echo 'export PATH="$HOME/.rbenv/bin:$PATH"' >> ~/.bashrc
echo 'eval "$(rbenv init -)"' >> ~/.bashrc
exec $SHELL

git clone https://github.com/rbenv/ruby-build.git ~/.rbenv/plugins/ruby-build
echo 'export PATH="$HOME/.rbenv/plugins/ruby-build/bin:$PATH"' >> ~/.bashrc
exec $SHELL

git clone https://github.com/rbenv/rbenv-gem-rehash.git ~/.rbenv/plugins/rbenv-gem-rehash

rbenv install 2.3.0
rbenv global 2.3.0
ruby -v

----INSTALL pragmatic_segmenter------------

apt-get install gem
gem install pragmatic_segmenter

-----INSTALL pdf2htmlex UBUNTU-----

-sudo apt-add-repository ppa:coolwanglu/pdf2htmlex
-sudo apt-get update
-sudo apt-get install pdf2htmlex