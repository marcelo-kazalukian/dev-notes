## Moving to another branch without committing the current changes, doing something in another branch, coming back to the initial branch and seeing the uncommitted changes.
```
# stash uncommitted changes
git stash

# move to another branch
git checkout feature

# do some changes, commit and push them
git add .
git commit -m "comment"
git push

# come back to the previous branch
git checkout previous_branch

# retrieve the changes
git stash pop
```
