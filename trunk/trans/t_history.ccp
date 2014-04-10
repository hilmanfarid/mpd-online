<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\trans" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="CoffeeBreak" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Record id="3" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="None" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" name="p_room_typeSearch" wizardCaption="Search P App Role " wizardOrientation="Vertical" wizardFormMethod="post" returnPage="t_history.ccp" PathID="p_room_typeSearch">
			<Components>
				<Button id="4" urlType="Relative" enableValidation="True" isDefault="False" name="Button_DoSearch" operation="Search" wizardCaption="Search" PathID="p_room_typeSearchButton_DoSearch">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="5" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="s_keyword" wizardCaption="Keyword" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" PathID="p_room_typeSearchs_keyword">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
			</Components>
			<Events/>
			<TableParameters/>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables/>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters/>
			<IFormElements/>
			<USPParameters/>
			<USQLParameters/>
			<UConditions/>
			<UFormElements/>
			<DSPParameters/>
			<DSQLParameters/>
			<DConditions/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="15" name="p_room_typeGrid" connection="ConnSIKP" dataSource="SELECT *, p.code, t.code as type_code
FROM h_vat_setllement h
LEFT JOIN p_finance_period p 
on p.p_finance_period_id = h.p_finance_period_id
LEFT JOIN p_settlement_type t 
on t.p_settlement_type_id = h.p_settlement_type_id
WHERE h.npwd LIKE '%{s_keyword}%'
ORDER BY h.updated_date" pageSizeLimit="100">
<Components>
<Link id="11" visible="Yes" fieldSourceType="CodeExpression" dataType="Text" html="True" hrefType="Page" urlType="Relative" preserveParameters="GET" name="DLink" hrefSource="t_history.ccp" removeParameters="FLAG" PathID="p_room_typeGridDLink">
<Components/>
<Events/>
<LinkParameters>
<LinkParameter id="164" sourceType="DataField" format="yyyy-mm-dd" name="p_room_type_id" source="p_room_type_id"/>
</LinkParameters>
<Attributes/>
<Features/>
</Link>
<Label id="15" fieldSourceType="DBColumn" dataType="Text" html="False" name="code" fieldSource="npwd" PathID="p_room_typeGridcode">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="17" fieldSourceType="DBColumn" dataType="Text" html="False" name="periode_code" fieldSource="code" PathID="p_room_typeGridperiode_code">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Navigator id="22" size="10" type="Centered" pageSizes="1;5;10;25;50" name="Navigator">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Navigator>
<Label id="19" fieldSourceType="DBColumn" dataType="Text" html="False" name="settlement_date" fieldSource="settlement_date" PathID="p_room_typeGridsettlement_date">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="166" fieldSourceType="DBColumn" dataType="Text" html="False" name="settlement_type" fieldSource="type_code" PathID="p_room_typeGridsettlement_type">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="168" fieldSourceType="DBColumn" dataType="Text" html="False" name="modification_type" fieldSource="modification_type" PathID="p_room_typeGridmodification_type">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
<Label id="169" fieldSourceType="DBColumn" dataType="Text" html="False" name="alasan" fieldSource="alasan" PathID="p_room_typeGridalasan">
<Components/>
<Events/>
<Attributes/>
<Features/>
</Label>
</Components>
<Events>
<Event name="BeforeSelect" type="Server">
<Actions>
<Action actionName="Custom Code" actionCategory="General" id="150"/>
</Actions>
</Event>
<Event name="BeforeShowRow" type="Server">
<Actions>
<Action actionName="Set Row Style" actionCategory="General" id="151" styles="Row;AltRow" name="rowStyle"/>
</Actions>
</Event>
</Events>
<TableParameters>
<TableParameter id="8" conditionType="Parameter" useIsNull="False" field="upper(code)" dataType="Text" searchConditionType="Contains" parameterType="URL" parameterSource="s_keyword" logicOperator="Or" orderNumber="1" leftBrackets="0"/>
<TableParameter id="9" conditionType="Parameter" useIsNull="False" field="upper(description)" dataType="Text" searchConditionType="Contains" parameterType="URL" parameterSource="s_keyword" logicOperator="Or" orderNumber="2" rightBrackets="0"/>
</TableParameters>
<JoinTables/>
<JoinLinks/>
<Fields/>
<SPParameters/>
<SQLParameters>
<SQLParameter id="149" variable="s_keyword" dataType="Text" parameterType="URL" parameterSource="s_keyword"/>
</SQLParameters>
<SecurityGroups/>
<Attributes/>
<Features/>
</Grid>
</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="t_history_events.php" forShow="False" comment="//" codePage="windows-1252"/>
		<CodeFile id="Code" language="PHPTemplates" name="t_history.php" forShow="True" url="t_history.php" comment="//" codePage="windows-1252"/>
	</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnInitializeView" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="66"/>
			</Actions>
		</Event>
	</Events>
</Page>
