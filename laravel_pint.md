## How to setup Pint

Control + alt + O to open the "search actions" feature

Type "file watcher"

Click on the + symbol and select custom

Complete with

```

Name: Pint

File type: PHP

Scope: Project Files

Program: $ProjectFileDir$\vendor\bin\pint

Arguments: $FileRelativePath$

Output paths to refresh: $FileRelativePath$

Working directory: $ProjectFileDir$

Expand the "advanced options"

Uncheck: Auto-save edited files to trigger the watcher

Check: Trigger the watcher on external changes.

```

Click on Save.

## Check if Pint is the only formatter for PHP

Control + alt + O to open the "search actions" feature

Type "Actions on Save"

Check "Reformat code" BUT click on the file type list and uncheck PHP

Click on save.
