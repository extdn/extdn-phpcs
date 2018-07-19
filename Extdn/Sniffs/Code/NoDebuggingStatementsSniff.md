# Rule: Do not keep debugging messages in your production code
## Background
Not everybody uses XDebug all the time. Sometimes a quick `print_r()` or `die()` is easier. However, when releasing code to production, these debugging messages
should not be in your code. If production code still contains debugging messages it could be a sign that more is at hand.

## Reasoning
Functions like `die()`, `print_r`, `var_export` and `var_dump` are only added while debugging code. Once debugging has finished, these code segments should be
removed.

## How it works
This rule scans the source code for strings that match debugging functions.

## How to fix
Simply remove the debugging statements from your code.
